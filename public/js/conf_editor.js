   window.onload = function(){
	CKEDITOR.replace( 'new',
	    {
		extraPlugins : 'bbcode',
		toolbar :
		[
			['Source', '-', 'Save','NewPage','-','Undo','Redo'],
			['Find','Replace','-','SelectAll','RemoveFormat'],
			['Link', 'Unlink'],
			'/',
			['FontSize', 'Bold', 'Italic','Underline'],
			['NumberedList','BulletedList','-','Blockquote'],
			['TextColor', '-', 'Smiley','SpecialChar', '-', 'Maximize']
		]
	    });
    };

