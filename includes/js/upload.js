
// Rookie Small Ads uploader
jQuery(document).ready(function(){
  var ro_widget_upload;
  jQuery(".ad-upload-image").live("click",function(e){
    var field=jQuery(this).prev(".ad-image-field");
    e.preventDefault();
    if(ro_widget_upload){ro_widget_upload.open();
      return
    }

    ro_widget_upload=wp.media.frames.ro_widget_upload=wp.media({className:"media-frame ro-media-manager",multiple:true,title:"Select Images",button:{text:"Select"}});
    ro_widget_upload.on("select",function(){
      var selection=ro_widget_upload.state().get("selection");
      selection.map(function(attachment){attachment=attachment.toJSON();
        field.val(attachment.url)
      })
    });
    ro_widget_upload.open()
  });

  jQuery(".wrap-btn .upload").live("click",function(e){
    var field=jQuery(this).parent().prev(".upload-field-btn");
    e.preventDefault();
    if(ro_widget_upload){ro_widget_upload.open();
      return
    }

    ro_widget_upload=wp.media.frames.ro_widget_upload=wp.media({className:"media-frame ro-media-manager",multiple:true,title:"Select Images",button:{text:"Select"}});
    ro_widget_upload.on("select",function(){
      var selection=ro_widget_upload.state().get("selection");
      selection.map(function(attachment){attachment=attachment.toJSON();
        field.val(attachment.url)
      })
    });
    ro_widget_upload.open()
  })
});


jQuery(document).ready(function(){
  var ro_widget_upload;
  jQuery(".ad-upload-image2").live("click",function(e){
    var field=jQuery(this).prev(".ad-image-field2");
    e.preventDefault();
    if(ro_widget_upload){ro_widget_upload.open();
      return
    }

    ro_widget_upload=wp.media.frames.ro_widget_upload=wp.media({className:"media-frame ro-media-manager",multiple:true,title:"Select Images",button:{text:"Select"}});
    ro_widget_upload.on("select",function(){
      var selection=ro_widget_upload.state().get("selection");
      selection.map(function(attachment){attachment=attachment.toJSON();
        field.val(attachment.url)
      })
    });
    ro_widget_upload.open()
  });

  jQuery(".wrap-btn .upload").live("click",function(e){
    var field=jQuery(this).parent().prev(".upload-field-btn");
    e.preventDefault();
    if(ro_widget_upload){ro_widget_upload.open();
      return
    }

    ro_widget_upload=wp.media.frames.ro_widget_upload=wp.media({className:"media-frame ro-media-manager",multiple:true,title:"Select Images",button:{text:"Select"}});
    ro_widget_upload.on("select",function(){
      var selection=ro_widget_upload.state().get("selection");
      selection.map(function(attachment){attachment=attachment.toJSON();
        field.val(attachment.url)
      })
    });
    ro_widget_upload.open()
  })
});

// Rookie Big Ads uploader
jQuery(document).ready(function(){
  var ro_widget_upload;
  jQuery(".ad-upload-image3").live("click",function(e){
    var field=jQuery(this).prev(".ad-image-field3");
    e.preventDefault();
    if(ro_widget_upload){ro_widget_upload.open();
      return
    }

    ro_widget_upload=wp.media.frames.ro_widget_upload=wp.media({className:"media-frame ro-media-manager",multiple:true,title:"Select Images",button:{text:"Select"}});
    ro_widget_upload.on("select",function(){
      var selection=ro_widget_upload.state().get("selection");
      selection.map(function(attachment){attachment=attachment.toJSON();
        field.val(attachment.url)
      })
    });
    ro_widget_upload.open()
  });

  jQuery(".wrap-btn .upload").live("click",function(e){
    var field=jQuery(this).parent().prev(".upload-field-btn");
    e.preventDefault();
    if(ro_widget_upload){ro_widget_upload.open();
      return
    }

    ro_widget_upload=wp.media.frames.ro_widget_upload=wp.media({className:"media-frame ro-media-manager",multiple:true,title:"Select Images",button:{text:"Select"}});
    ro_widget_upload.on("select",function(){
      var selection=ro_widget_upload.state().get("selection");
      selection.map(function(attachment){attachment=attachment.toJSON();
        field.val(attachment.url)
      })
    });
    ro_widget_upload.open()
  })
});
