<?php

namespace templates;

class Template
{
	public string $template;

	public function __construct(string $style)
	{
		$s = $style . ".css";
		echo "<link rel=\"stylesheet\" href=\"./" . $s . "\">";
	}

	public static function Render(Template $t): string
	{
		return $t->template;
	}
}