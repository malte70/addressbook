<?php
/**
 * about.php
 * 
 * Part of malte70's addressbook
 *   https://github.com/malte70/addressbook
 * 
 * Copyright (c) 2015 Malte Bublitz, http://malte-bublitz.de
 * All rights reserved.
 */

require_once("config.inc.php");

$TITLE = "About";
$IGNORE_LOGIN = true;
$CONTENT = <<<EOF
<h3>About $APP_NAME</h3>
<p>
	$APP_NAME is a small personal address book I made for personal usage.
</p>
<p>
	The code can be found in the project's <a href="$APP_URL">Github repository</a>.
</p>
<section id="license">
	<h3>License</h3>
	<p>
		Copyright &copy; 2015 <a href="http://malte-bublitz.de">Malte Bublitz</a><br>
		All rights reserved.
	</p>
	<p>
		Redistribution and use in source and binary forms, with or without modification,
		are permitted provided that the following conditions are met:
	</p>
	<ol>
		<li>
			Redistributions of source code must retain the above copyright notice, this
			list of conditions and the following disclaimer.
		</li>
		<li>
			Redistributions in binary form must reproduce the above copyright notice,
			this list of conditions and the following disclaimer in the documentation
			and/or other materials provided with the distribution.
		</li>
	</ol>
	<p>
		THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
		INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
		FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE AUTHOR
		AND/OR CONTRIBUTORS OF WindowsInfo BE LIABLE FOR ANY DIRECT, INDIRECT,
		INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
		LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
		PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
		LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE
		OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
		ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
	</p>
</section>
EOF;

require_once("template.inc.php");
?>
