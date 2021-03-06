<?php 

/* NethServer_Module_FirewallObjects translation, language: it */

$L['FirewallObjects_Description'] = 'Gestione oggetti del firewall';
$L['FirewallObjects_Tags'] = 'firewall zone host servizio servizi gruppo gruppi oggetti';
$L['FirewallObjects_Title'] = 'Oggetti firewall';

$L['esp_label'] = 'ESP';
$L['gre_label'] = 'GRE';
$L['HostGroupsKey_label'] = 'Gruppo';
$L['HostGroups_create_label'] = 'Crea un nuovo gruppo di host';
$L['HostGroups_CreateHostGroup_label'] = 'Crea un nuovo gruppo di host';
$L['HostGroups_update_label'] = 'Modifica il gruppo di host "${0}"';
$L['HostGroups_Title'] = 'Gruppi di host';
$L['HostsKey_label'] = 'Host';
$L['Host_key_exists_message'] = 'Identificatore host già in uso';
$L['Hosts_create_label'] = 'Crea un nuovo host';
$L['Hosts_CreateHost_label'] = 'Crea un nuovo host';
$L['Hosts_update_label'] = 'Modifica l\'host "${0}"';
$L['Hosts_Title'] = 'Host';
$L['icmp_label'] = 'ICMP';
$L['Interface_label'] = 'Interfaccia';
$L['IpAddress_label'] = 'Indirizzo IP';
$L['Members_label'] = 'Membri';
$L['Members'] = 'Membri';
$L['Network_label'] = 'Indirizzo di rete';
$L['Ports_label'] = 'Porte';
$L['Ports_validator'] = 'Elenco di porte separato da virgola';
$L['Protocol_label'] = 'Protocollo';
$L['name_label'] = 'Nome';
$L['ServicesKey_label'] = 'Servizio';
$L['Services_create_label'] = 'Crea un nuovo servizio';
$L['Service_key_exists_message'] = 'Identificatore servizio già in uso';
$L['Services_CreateService_label'] = 'Crea un nuovo servizio';
$L['Services_update_label'] = 'Modifica il servizio "${0}"';
$L['Services_Title'] = 'Servizi';
$L['tcp_label'] = 'TCP';
$L['tcpudp_label'] = 'TCP e UDP';
$L['udp_label'] = 'UDP';
$L['ZonesKey_label'] = 'Zona';
$L['Zones_create_label'] = 'Crea una nuova zona';
$L['Zone_key_exists_message'] = 'Identificatore zona già in uso';
$L['Zones_CreateZone_label'] = 'Crea una nuova zona';
$L['Zones_update_label'] = 'Modifica la zona "${0}"';
$L['Zones_Title'] = 'Zone';

$L['valid_platform,fwobject-zone-delete,fwobject-referenced,3'] = 'Impossibile eliminare ${2}. La zona è utilizzata dalle regole del firewall.';
$L['valid_platform,fwobject-fwservice-delete,fwobject-referenced,3'] = 'Impossibile eliminare ${2}. Il servizio è utilizzato dalle regole del firewall.';
$L['valid_platform,fwobject-host-delete,fwobject-referenced,3'] = 'Impossibile eliminare ${2}. L\'host è utilizzato dalle regole del firewall.';
$L['valid_platform,fwobject-host-group-delete,fwobject-referenced,3'] = 'Impossibile eliminare ${2}. Il gruppo di host è utilizzato dalle regole del firewall.';
$L['valid_platform,fwobject-host-delete,fwobject-hostgroup-remove-member,3'] = 'Impossibile eliminare ${2}: è l\'ultimo membro del gruppo di host ${${reason}}.';