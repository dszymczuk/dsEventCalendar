<?php     
defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<input type="text" name="shortname" value="" />

<p><input type="radio" name="protocol" value="0" checked /> Use HTTP</p>
<p><input type="radio" name="protocol" value="1" /> Use HTTPS</p>

<hr />

<p>If you are testing the system on an inaccessible website, e.g. secured staging server or a local environment:</p>
<input type="checkbox" name="disqus_developer" value="1" /><label for="disqus_developer">Enable Developer Mode</label>
