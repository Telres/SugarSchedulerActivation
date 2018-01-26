<?php

/**
 * GAM#DAC
 */

array_push($job_strings, 'lftm_it_data_ativacao_job');

function lftm_it_data_ativacao_job() {
		
	$sql = "SELECT T3.id, T0.id_c FROM ger01_gerenciamentocliente_cstm T0 INNER JOIN ";
	$sql .= "ger01_gerenciamentocliente T1 ON T0.id_c = T1.id AND T1.deleted = 0 INNER JOIN ";
	$sql .= "ger01_gerenciamentocliente_contacts_c T2 ON T1.id = T2.ger01_gere60bccliente_idb AND T2.deleted = 0 INNER JOIN ";
	$sql .= "contacts T3 ON T3.id = T2.ger01_gerenciamentocliente_contactscontacts_ida AND T3.deleted = 0 INNER JOIN ";
	$sql .= "contacts_cstm T4 ON T4.id_c = T3.id ";
	$sql .= "WHERE T0.lftm_mes_referencia_c IS NOT NULL ORDER BY T3.first_name;";

	$cnt = 0;
	$conn = $GLOBALS['db']->getConnection();
	
	$GLOBALS['log']->fatal('Got Connection');
	
	$stmt = $conn->executeQuery($sql);
	
	$GLOBALS['log']->fatal('Query executed');
	
	while($row = $stmt->fetch()) {	
	
		$gCliente_bean = BeanFactory::retrieveBean('Ger01_GerenciamentoCliente', $row['id_c'], array('disable_row_level_security' => true));
		$contact_bean = BeanFactory::retrieveBean('Contacts', $row['id'], array('disable_row_level_security' => true));
		
		if(!empty($contact_bean->lftm_data_ativacao_c)) {
			if($gCliente_bean->lftm_mes_referencia_c < $contact_bean->lftm_data_ativacao_c) {
				$contact_bean->lftm_data_ativacao_c = $gCliente_bean->lftm_mes_referencia_c;
				$contact_bean->save();
			}
		} else {
			$contact_bean->lftm_data_ativacao_c = $gCliente_bean->lftm_mes_referencia_c;
			$contact_bean->save();
		}
		$GLOBALS['log']->fatal('Processing Client: '. $contact_bean->first_name .' '. $contact_bean->last_name .'| Activation Date: ' . $contact_bean->lftm_data_ativacao_c . '| Reference Month: ' . $gCliente_bean->lftm_mes_referencia_c);
		$cnt++;
	}
	
	$GLOBALS['log']->fatal(''. $cnt .' Registers Saved');
    return true;

}
