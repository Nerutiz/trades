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
dojo.require("dojo.dnd.Source");
dojo.require("dojo.data.ItemFileReadStore");
dojo.require("trades.DragNDrop");

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

function changePasswordDialog()
{
	 secondDlg = new dojox.widget.Dialog({
		 title: "Change password",
		 layoutAlign: 'center',
		 id:'changePasswordDialog',
		 draggable:false,
		 dimensions: [300,190],
         onCancel:function()
	      {
	    	 this.destroyRecursive();
	      },
	      onLoad:function()
	      {
	    	
	      }
     });
	 secondDlg.set('href', '/account/changepassword');
	 secondDlg.show();
	 
}

function loginDialog()
{
	 secondDlg = new dojox.widget.Dialog({
		 title: "Change password",
		 layoutAlign: 'center',
		 id:'changePasswordDialog',
		 draggable:false,
		 dimensions: [300,190],
         onCancel:function()
	      {
	    	 this.destroyRecursive();
	      },
	      onLoad:function()
	      {
	    	
	      }
     });
	 secondDlg.set('href', '/account/changepassword');
	 secondDlg.show();
	 
}

function changePassword()
{
	newpasswords = dijit.byId('newpassword').get('value');
	if(dijit.byId('newpassword').get('value') == dijit.byId('repeatpassword').get('value'))
	{
		dojo.xhrPost({
			url:'/account/changepassword',
			contetn:{oldpassword:dijit.byId('oldpassword').get('value'),newpassword:newpasswords}
		});
	}
	else
		alert('Passwords do not match');
}

function deleteImage(element, uuid, id)
{	
	dojo.xhrPost({
		url:'/things/deletefile',
		content:{file:dojo.attr(element, 'src'), uuid:uuid, id:id}
	});
	dojo.destroy(element.parentNode);
}

function setMainImage(imageId, thingId)
{
	dojo.query('.mainImage').forEach(function(node){
		dojo.removeClass(node, 'mainImage');
	});
	dojo.addClass(dojo.byId(imageId), 'mainImage');
	dojo.xhrPost({
		url:'/things/setmainimage',
		content:{imageid:imageId, thingid:thingId}
	});
}

function catalogNodeCreator(items, containerID)
{
	dojo.forEach(items, function(item){
		console.debug(item.id);
		});
	return;
	
	var container = dojo.byId(container);
	if(!container)
    var tr = document.createElement("tr");
    var imgTd = document.createElement("td");
    var nameTd = document.createElement("td");
    var wishesTd = document.createElement("td");
    var descTd = document.createElement("td");

    var img = document.createElement("img");
    	img.width=50;
    	if(!item.uuid)
    		img.src = "/images/" + "noPhoto.gif";
    	else
        	img.src = "/uploads/" + item.uuid + '.' + item.ext;
    dojo.addClass(imgTd, "itemImg");
    dojo.addClass(imgTd, "dojoDndHandle");
    imgTd.appendChild(img);

    nameTd.appendChild(document.createTextNode(item.title));

    descTd.innerHTML = item.description;
    wishesTd.innerHTML = item.wishes;
    dojo.addClass(nameTd, "itemText");
    
    tr.appendChild(imgTd);
    tr.appendChild(nameTd);
    tr.appendChild(descTd);
    tr.appendChild(wishesTd);
    var node = tr;
    tr.id = item.id;
    node.data = item;
    if(hint == "avatar"){
        // put the avatar into a self-contained table
        var table = document.createElement("table");
        var tbody = document.createElement("tbody");
        var avatarTr = document.createElement("tr");
        var tdDesc = document.createElement("td");
        tdDesc.innerHTML = item.title;
        avatarTr.appendChild(tdDesc);
        avatarTr.appendChild(imgTd);
        tbody.appendChild(avatarTr);
        table.appendChild(tbody);
        node = table;
    }

    var type = item.title ? ["inStock"] : ["outOfStock"];

    return {node: node, data: item, type: type};
}

// create a dojo.dnd.Source from the data provided
function buildCatalog(node, data)
{
    var dndObj = new dojo.dnd.Source(node, {copyOnly: true, creator: catalogNodeCreator});
    dndObj.insertNodes(false, data);
    dndObj.forInItems(function(item, id, map){
        dojo.addClass(id, item.type[0]);
    });
    return dndObj;
}

function sourceCreator(item, hint)
{
	var div = document.createElement('div');
	var descSpan = document.createElement('span');
	var img = document.createElement('img');
	descSpan.innerHTML = item.title;
	dojo.addClass(descSpan,'targetNodes');
	dojo.addClass(img, 'targetNodes');
	img.width = 50;
	if(item.uuid)
		img.src = '/uploads/' + item.uuid + '.' + item.ext; 
	else
		img.src = '/images/noPhoto.gif';
	div.appendChild(descSpan);
	div.appendChild(img);
	dojo.addClass(div, 'targetChild');
	div.id = item.id;
	return {node:div, data:item, type:["inStock"]};
}

function checkAcceptanceWithoutSelfDrop(source, nodes) {
    if(this == source){return false;}
    for(var i = 0; i < nodes.length; ++i){
        var type = source.getItem(nodes[i].id).type;
        var flag = false;
        for(var j = 0; j < type.length; ++j){
            if(type[j] in this.accept){
                flag = true;
                break;
            }
        }
        if(!flag){
            return false;
        }
    }
    return true;
}

function saveTrade(userId, mythingId, otherthingid)
{
	dojo.xhrPost({
		url:'/trades/savetrade',
		content:{userid:userId, mythingid:mythingId, otherthingid:otherthingId}
	});
}

function test(source, nodes, copy)
{
	dojo.forEach(nodes, function(node){
		console.debug(node.data);
	});
}

function setTradeParams(item)
{
	paramField = dojo.byId('params');
	dojo.attr(paramField, 'value', paramField.value + item);
}

function selectAllUsers(userID)
{
	dojo.xhrPost({
		url:'/trades/index',
		content:{userid:userID}
	});
}

function removeItem(itemID, item)
{
    var conf = confirm("Ar tikrai norite atlikit šį veiksmą?");
    if (conf){
        
	dojo.xhrPost({
		url:'/things/deletething',
		content:{itemid:itemID}
	});
        dojo.destroy(item);
    }
}



trades.formDialog = function()
{
    formDialog = new dojox.widget.Dialog({
        title: "Registracija",
        layoutAlign: 'center',
        id:'registerDialog',
        draggable:false,
        'class':'formDialog',
        dimensions: [320,230],
        onCancel:function()
        {
        this.destroyRecursive();
        }
    });
    formDialog.set('href', '/account/register');
    formDialog.show();
}

function setActive(element)
{
    var element = element.parentNode;
    if(dojo.hasClass(element, 'activeUser'))
        dojo.removeClass(element, 'activeUser');
    else
        dojo.addClass(element, 'activeUser');
}