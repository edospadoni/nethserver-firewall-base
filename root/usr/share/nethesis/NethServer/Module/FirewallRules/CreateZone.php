<?php

namespace NethServer\Module\FirewallRules;

/*
 * Copyright (C) 2014  Nethesis S.r.l.
 *
 * This script is part of NethServer.
 *
 * NethServer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * NethServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with NethServer.  If not, see <http://www.gnu.org/licenses/>.
 */

use Nethgui\System\PlatformInterface as Validate;

/**
 * Create a new Zone record
 *
 * @author Davide Principi <davide.principi@nethesis.it>
 * @since 1.0
 */
class CreateZone extends \Nethgui\Controller\Collection\AbstractAction
{
    /**
     *
     * @var \NethServer\Module\FirewallRules\RuleWorkflow
     */
    private $state;
    
    private $interfaces;

    protected function initializeAttributes(\Nethgui\Module\ModuleAttributesInterface $attributes)
    {
        return new \NethServer\Tool\CustomModuleAttributesProvider($attributes, array('languageCatalog' => 'NethServer_Module_FirewallObjects'));
    }

    public function initialize()
    {
        parent::initialize();
        $nameValidator = $this->getPlatform()->createValidator()->maxLength(5)->username();
        if (!$this->interfaces) {
            $this->interfaces = $this->readInterfaces();
        }
        $interfaceValidator = $this->getPlatform()->createValidator()->memberOf($this->interfaces);

        $this->state = new \NethServer\Module\FirewallRules\RuleWorkflow();
        $this->declareParameter('name', $nameValidator);
        $this->declareParameter('Network', Validate::CIDR_BLOCK);
        $this->declareParameter('Interface', $interfaceValidator);
        $this->declareParameter('Description', Validate::ANYTHING);
        $this->declareParameter('f', $this->createValidator()->memberOf('d', 's'));
        $this->declareParameter('i', Validate::POSITIVE_INTEGER);
        $this->declareParameter('q', Validate::ANYTHING);
    }

    public function bind(\Nethgui\Controller\RequestInterface $request)
    {
        parent::bind($request);
        if ($request->isMutation()) {
            return;
        }
        $hint = $request->getParameter('q');
        if ($hint !== NULL) {
            foreach (array('name', 'Interface', 'Network', 'Description') as $key) {
                if ($this->getValidator($key)->evaluate($hint)) {
                    $this->parameters[$key] = $hint;
                }
            }
        }
    }

    public function validate(\Nethgui\Controller\ValidationReportInterface $report)
    {
        $key = $this->parameters['name'];
        if ($this->getPlatform()->getDatabase('networks')->getType($key)) {
            $report->addValidationErrorMessage($this, 'name', 'Zone_key_exists_message');
        }
        parent::validate($report);
    }

    public function process()
    {
        parent::process();
        if ($this->getRequest()->isMutation()) {
            $this->getPlatform()
                ->getDatabase('networks')->setKey($this->parameters['name'], 'zone', array(
                'Description' => $this->parameters['Description'],
                'Interface' => $this->parameters['Interface'],
                'Network' => $this->parameters['Network'],
            ));
            $this->state->resume($this->getParent()->getSession())->assign(sprintf("zone;%s", $this->parameters['name']));
        }
    }

    private function readInterfaces() {
        $ret = array();
        $types = array('bridge', 'bond', 'vlan', 'ethernet');
        $interfaces = $this->getPlatform()->getDatabase('networks')->getAll();
        foreach ($interfaces as $key => $props) {
           if (in_array($props['type'], $types)) {
               $ret[] = $key;
           }
        }
        return $ret;
    }

    public function prepareView(\Nethgui\View\ViewInterface $view)
    {
        parent::prepareView($view);
        if (!$this->interfaces) {
            $this->interfaces = $this->readInterfaces();
        }
        $view['InterfaceDatasource'] = array_map(function($fmt) use ($view) {
                                return array($fmt, $fmt);
        }, $this->interfaces);

        $view->setTemplate('NethServer/Template/FirewallObjects/Zones/Modify');
        if ( ! $this->getRequest()->isValidated()) {
            return;
        }
        if ($this->getRequest()->isMutation()) {
            $view->getCommandList()->sendQuery($view->getModuleUrl('../' . $this->state->getReturnPath()));
        } else {
            $view->getCommandList()->show();
        }
    }

}
