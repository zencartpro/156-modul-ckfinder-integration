<?php
/**
 * @package admin
 * @copyright Copyright 2003-2021 Zen Cart Development Team
 * @copyright Portions Copyright 2010 Kuroi Web Design
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ckeditor.php for ckfinder 2021-06-24 17:22:32Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$var = zen_get_languages();
$jsLanguageLookupArray = "var lang = new Array;\n";
foreach ($var as $key)
{
  $jsLanguageLookupArray .= "  lang[" . $key['id'] . "] = '" . $key['code'] . "';\n";
}
?>
<script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-2.1.3.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4" crossorigin="anonymous"><\/script>');</script>
<script>window.jQuery || document.write('<script src="includes/javascript/ckfinder-jquery.js"><\/script>');</script>
<script type="text/javascript" src="../<?php echo DIR_WS_EDITORS; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../<?php echo DIR_WS_EDITORS ?>ckfinder/ckfinder.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  <?php echo $jsLanguageLookupArray ?>
  $('textarea').each(function() {
    if ($(this).attr('class') == 'editorHook' || ($(this).attr('name') != 'message' && $(this).attr('class') != 'noEditor'))
    {
      index = $(this).attr('name').match(/\d+/);
      if (index == null) index = <?php echo $_SESSION['languages_id'] ?>;
      var editor = CKEDITOR.replace($(this).attr('name'),
        {
          coreStyles_underline : { element : 'u' },
          width : 760,
          language: lang[index]
        });
      if (CKFinder != undefined) {
        CKFinder.setupCKEditor( editor, { language: lang[index] }, { type: 'Files' } );
      }
    }
  });
});
</script>
<?php 
// for pseudo auth, use list of admin-approved IP addresses from the Maintenance list:
file_put_contents('../' . DIR_WS_EDITORS . '.allowed_ips.txt', EXCLUDE_ADMIN_IP_FOR_MAINTENANCE);