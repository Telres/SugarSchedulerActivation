<?php

$manifest = array(    
    'acceptable_sugar_versions' =>
        array (
            'regex_matches' => array(
                0 => '7\.*'
            )
        ),
    'acceptable_sugar_flavors' =>
        array (
            0 => 'ENT',
            1 => 'ULT',
            2 => 'PRO'
        ),
    'readme' => '',
    'key' => 'DAC',
    'name' => 'DAC',
    'author' => 'giovanni.marazzi',
    'description' => 'Configura a Data de Ativação do Cliente como sendo a  mais antiga de depósito',
    'is_uninstallable' => true,
    'published_date' => '2018-01-24',
    'type' => 'module',
    'version' => '2.0',
    'remove_tables' => 'prompt'
);

$installdefs = array (
    'id' => 'DAC',
    'copy' => array(
		array(
			'from' => '<basepath>/custom/Extension/modules/Schedulers/Ext/Language/pt_BR.lftm_it_data_ativacao_job.php',
			'to'   => 'custom/Extension/modules/Schedulers/Ext/Language/pt_BR.lftm_it_data_ativacao_job.php',
		),
		array(
			'from' => '<basepath>/custom/Extension/modules/Schedulers/Ext/ScheduledTasks/lftm_it_data_ativacao_job.php',
			'to'   => 'custom/Extension/modules/Schedulers/Ext/ScheduledTasks/lftm_it_data_ativacao_job.php',
		)
	),
	'post_execute' => 
    array (
         '<basepath>/actions/post_install_actions.php'
    )
);
