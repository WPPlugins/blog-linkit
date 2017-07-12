<?php
class bloglinkit_dashboard extends wv48fv_action {
	public function linkitWPmenuMeta($return) {
		$return ['menu'] = 'Links';
		$return ['title'] = $this->application()->name;
		$return ['slug'] = $this->application()->slug;
		if(!is_multisite())
		{
			$return ['menu'] = '';
		}
		return $return;
	}
}
		