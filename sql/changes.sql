ALTER TABLE `eva_file_files` ADD `configKey` VARCHAR(10) NOT NULL AFTER `storageAdapter`;

ALTER TABLE `eva_file_files` CHANGE `fileName` `fileName` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
