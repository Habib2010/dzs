TRUNCATE `cms_quicklink`;
TRUNCATE `links`;
TRUNCATE `nodes`;
TRUNCATE `cms_photos`;
TRUNCATE `cms_page_config`;
TRUNCATE `cms_album`;
TRUNCATE `cms_boxes`;




UPDATE `settings`
SET
  `value` = '/uploads/pngtree-real-estate-logo-3633486.png'
WHERE `id` = 40;

UPDATE `settings`
SET
  `value` = '/uploads/logoipsum-216.svg'
WHERE `id` = 41;

UPDATE `settings`
SET
  `value` = '0'
WHERE `id` = 59;