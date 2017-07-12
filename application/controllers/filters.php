<?php
class bloglinkit_filters extends wv48fv_action {
	public function the_contentWPfilter($content) {
		$tag = bv48fv_Tag::instance ();
		$this->blogs()->swap($this->data()->multisite['blog_id']);
		$links = get_bookmarks ( array ('hide_invisible' => 0, 'category_name' => 'LinkIt' ) );
		$this->blogs()->swap();
		usort ( $links, array ($this, 'rlenCompare' ) );
		$tag->tokenise ( $content );
		$cnt = count ( $content->tokens );
		foreach ( ( array ) $links as $link ) {
			$token = "#" . str_pad ( $cnt, 4, "0", STR_PAD_LEFT ) . "#";
			$content->text = preg_replace ( '|\b(' . $link->link_name . ')\b|Ui', $token, $content->text );
			$target = '';
			$this->view->target = $target;
			$this->view->link = $link;
			$content->tokens [$cnt] = $this->render_script('front/link.phtml');
			$cnt ++;
		}
		$tag->detokenise ( $content );
		return $content;
	}
	public function rlenCompare($x, $y) {
		if (strlen ( $x->link_name ) == strlen ( $y->link_name )) {
			return 0;
		} else if (strlen ( $x->link_name ) < strlen ( $y->link_name )) {
			return 1;
		} else {
			return - 1;
		}
	}
}
		