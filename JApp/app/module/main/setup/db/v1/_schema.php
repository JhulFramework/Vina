<?php return
[
	'appTableMeta' =>
	[
		'fields' =>
		'
			`identityKey` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`tableName` varchar(99) NOT NULL UNIQUE KEY,
			`itemsCount` int(11) NOT NULL DEFAULT \'0\',
			`lastItemKey` int(11) NOT NULL DEFAULT \'0\'
		',

		'meta' => 'ENGINE=InnoDB DEFAULT CHARSET=latin1',
	],
];
