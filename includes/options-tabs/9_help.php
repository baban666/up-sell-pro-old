<?php
return [array(
	'name'   => 'help',
	'title'  => 'Help',
	'icon'   => 'dashicons-sos',
	'fields' => array(
		array(
			'type'    => 'notice',
			'class'   => 'info', // chooses: info, primary, secondary, success, warning, danger
			'content' => 'This is info notice field for your highlight sentence.',
		),
		array(
			'type'    => 'card',
			'class'   => 'class-name',  // for all fieds
			'title'   => 'Panel Title', // Optional
			// HTML can be used.
			'content' => '<p>Etiam consectetur commodo ullamcorper. Donec quis diam nulla. Maecenas at mi molestie ex aliquet dignissim a in tortor. Sed in nisl ac mi rutrum feugiat ac sed sem. Nullam tristique ex a tempus volutpat. Sed ut placerat nibh, a iaculis risus. Aliquam sit amet erat vel nunc feugiat viverra. Mauris aliquam arcu in dolor volutpat, sed tempor tellus dignissim.</p><p>Quisque nec lectus vitae velit commodo condimentum ut nec mi. Cras ut ultricies dui. Nam pretium <a href="#">rutrum eros</a> ac facilisis. Morbi vulputate vitae risus ac varius. Quisque sed accumsan diam. Sed elementum eros lectus, et egestas ante hendrerit eu. Proin porta, enim nec dignissim commodo, odio orci maximus tortor, iaculis congue felis velit sed lorem. </p>',
			'header' => 'Header Text', // Optional
			'footer' => 'Footer Text', // Optional
		),

		array(
			'type'    => 'content',
			'class'   => 'class-name',     // optional
			'title'   => 'Content Title',  // optional
			'content' => '<p>Etiam consectetur commodo ullamcorper. Donec quis diam nulla. Maecenas at mi molestie ex aliquet dignissim a in tortor. Sed in nisl ac mi rutrum feugiat ac sed sem. Nullam tristique ex a tempus volutpat. Sed ut placerat nibh, a iaculis risus. Aliquam sit amet erat vel nunc feugiat viverra. Mauris aliquam arcu in dolor volutpat, sed tempor tellus dignissim.</p><p>Quisque nec lectus vitae velit commodo condimentum ut nec mi. Cras ut ultricies dui. Nam pretium <a href="#">rutrum eros</a> ac facilisis. Morbi vulputate vitae risus ac varius. Quisque sed accumsan diam. Sed elementum eros lectus, et egestas ante hendrerit eu. Proin porta, enim nec dignissim commodo, odio orci maximus tortor, iaculis congue felis velit sed lorem. </p>',
			'before' => 'Before Text',     // optional
			'after'  => 'After Text',      // optional
		),
	)
)];







