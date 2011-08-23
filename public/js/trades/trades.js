dojo.require("dijit.form.Select");
dojo.require("dijit.form.FilteringSelect");
dojo.require("dijit.layout.ContentPane");
dojo.require("dojox.layout.ContentPane");
dojo.require("dijit.layout.AccordionContainer");
dojo.require("dijit.layout.BorderContainer");
dojo.require("dijit.layout.SplitContainer");
dojo.require("dojox.widget.Dialog");
dojo.require("dijit.Dialog");
dojo.require("dijit.form.Form");
dojo.require("dijit.form.TextBox");
dojo.require("dijit.form.ValidationTextBox");
dojo.require("dijit.form.Textarea");
dojo.require("dojo.fx.easing");
dojo.require("dojox.form.PasswordValidator");
dojo.require("dojox.validate.regexp"); 
dojo.require("dijit.InlineEditBox");
dojo.require("dojox.form.Uploader");
dojo.require("dojox.form.uploader.FileList");
dojo.require("dojox.form.uploader.plugins.HTML5");

/*----- form-dijit form -----*/
function validateAndSubmitForm(formId)
{
	form = dijit.byId(formId);
	if(form.validate())
		form.submit();		
}

function validateForSubmit(formId)
{
	form = dijit.byId(formId);
	if(form.validate())
		form.submit();	
}

function saveRecord(column, value){
	 dojo.xhrPost({
		url:'/things/saverecord',
		content:{column:column, value:value},
		load: function(data, ioArgs){
			
		},
		error: function(err, ioArgs){
		    
		    console.error(err); // display the error
		    }
		 });
}

function editTaskDialog(taskId)
{
	 secondDlg = new dojox.widget.Dialog({
		 title: "Edit task",
		 layoutAlign: 'center',
		 id:'editTaskDialog',
		 draggable:false,
		 dimensions: [600,515],
		 style:'min-height:515px;',
         onCancel:function()
	      {
	    	 this.destroyRecursive();
	      },
	      onLoad:function()
	      {
	    	 dojo.byId('id').value = taskId;
	      }
     });
	 secondDlg.set('href', '/task/edit?id='+taskId);
	 secondDlg.show();
	 
}
