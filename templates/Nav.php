<?php

namespace templates;
class Nav extends Template
{
	public string $template = <<<TEMPLATE
<nav>
    <span>
		<a href="#">Strona główna</a>
    </span>
    <span>
		<a href="placowki.php">Placówki</a>
    </span>
    <span>
		<a href="login.php">Logowanie</a>
    </span>
</nav>

TEMPLATE;

	public function __construct()
	{
		parent::__construct(get_class());
	}
}