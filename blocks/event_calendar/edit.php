<?php     
defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<input type="text" name="shortname" value="<?php    echo $shortname; ?>" />

<p><input type="radio" name="protocol" value="0" <?php  if (intval($protocol) == 0) echo "checked"; ?> /> Use HTTP</p>
<p><input type="radio" name="protocol" value="1" <?php  if (intval($protocol) == 1) echo "checked"; ?> /> Use HTTPS</p>

<hr />

<p>If you are testing the system on an inaccessible website, e.g. secured staging server or a local environment:</p>
<input type="checkbox" name="disqus_developer" value="1" <?php  if (intval($disqus_developer) == 1) echo "checked"; ?>/><label for="disqus_developer">Enable Developer Mode</label>
