<?xml version="1.0"?>

<xsl:stylesheet version="1.0" 
 xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
 xmlns:x="http://www.w3.org/1999/xhtml" exclude-result-prefixes="x">
 
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"  doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" />

<xsl:template match='/'>

<table>
<!-- for che prende le competenze visibili -->
<xsl:for-each select='//*[@id="profile-skills"]/ul/li[@class="endorse-item"]'>
<tr>
<td>
<xsl:value-of select='span/span/a/text()'/> 
</td>
</tr>
</xsl:for-each>

<!-- for che prende le competenze nascoste -->
<xsl:for-each select='//*[@id="profile-skills"]/ul/li[@class="endorse-item extra-skill"]'>
<tr>
<td>
<xsl:value-of select='span/span/a/text()'/> 
</td>
</tr>
</xsl:for-each>


</table>


</xsl:template>

</xsl:stylesheet>