(function() {
    'use strict';

    function capital(){
      $('input:text:not(.link)').on('keydown', function(event) {
        if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
            var $t = $(this);
            event.preventDefault();
            var char = String.fromCharCode(event.keyCode);
            $t.val(char + $t.val().slice(this.selectionEnd));
            this.setSelectionRange(1, 1);
        }
      });
      $('textarea:not(.link)').on('keydown', function(event) {
        if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
            var $t = $(this);
            event.preventDefault();
            var char = String.fromCharCode(event.keyCode);
            $t.val(char + $t.val().slice(this.selectionEnd));
            this.setSelectionRange(1, 1);
        }
      });
    }

    function maskFunc(){      
      $('.currency:not(.modals)').each(function(){
        var   t = $(this),
              form = t.closest('form');
        t.mask('000.000.000.000.000', {reverse: true});
        form.submit(function(){
          //t.unmask();
          var unmask = t.val().split('.').join("");
        });
      });      
      $('.npwp').each(function(){
        $(this).mask('00.000.000.0-000.000');
      });
      $('.number').each(function(){
        $(this).mask('000000');
      })      
    }maskFunc();

    function init(){
      $('form.forms').submit(function(event){
        event.preventDefault();
        var t = $(this),
          action = t.attr('action'),
          button = t.find('.body').find('button[type=submit]'),
          method = t.find('input[name=_method]'),       
          data = new FormData($(this)[0]),
          teksbut = button.text();

        $.ajax({
          type: "POST",
          url: action,
          processData: false,
          contentType: false,
          cache: false,
          enctype: 'multipart/form-data',
          data: data,
          beforeSend: function(data){      
            //loader there          
            if(!t.hasClass('validating')){
              t.addClass('validating');
              //e.preventDefault();
            }
            button.addClass('loading').text('loading...');          
          }, success: function (data) {
            //return false;
            /*if(typeof method.val() !== 'undefined'){
              var url = action;
              url = url.slice(0, url.lastIndexOf('/'));             
              window.location = url;
            }else{              
              window.location = action;
            }*/
          }, error: function(data){            
            var res = data.responseJSON;            
            t.errMessage(res.errors);           
            if(t.hasClass('validating')){
              t.removeClass('validating');            
            }

            button.removeClass('loading');
            button.text(teksbut);
          }
        });
        //return false;
      });
    }

    $('.get-link').each(function(){
      var t = $(this);

      t.click(function(){
        var w = $(this),
            url = w.data('url'),
            target = w.data('target'),
            input = $(target).find('input');

        input.val(url);
      })
    });

    $('.depend').each(function() {
    var t = $(this),
      target = $('[name="' + t.data('target') + '"]'),
      v = t.data('value');

    function checkDepend(obj) {
      if (obj.prop('type') == "checkbox" || obj.prop('type') == "radio") {
        var isChecked = target.is(":checked");
        if (isChecked && !t.hasClass('reverse')) {
          t.show();
        }else if (isChecked && t.hasClass('reverse')) {
          t.hide();
        }else if (!isChecked && t.hasClass('reverse')) {
          t.show();
        }else {
          t.hide();
        }
      } else {
        var vv = target.val();

        if (vv == v && !t.hasClass('reverse')) {
          t.show().find(":input");
        } else if(vv != v && t.hasClass('reverse')){
          t.show()
        }else{
          t.hide();
        }
      }
    }
    target.change(function() {
      checkDepend($(this))
    })
    checkDepend(target);
  })

    $('.sinkron-form').each(function(){
      var t = $(this);

      t.submit(function(){
        $('#overlay').each(function(){
          $(this).fadeIn();
        });
      });      
    });

    $('.sinkron-server').each(function(){
      var t = $(this),
          form = t.closest('.box-body'),
          url = form.data('link');

      t.click(function(e){
        e.preventDefault();

        $('#overlay').each(function(){
          $(this).fadeIn();
        });

        $.ajax({ 
          type: 'GET', 
          url: url, 
          dataType: 'json',
          success: function (data) { 
            var information = JSON.parse(data);
            alert(JSON.stringify(information, null, 4));
            console.log('sukses');
            return false;
            /*$.post("/cbt/simpan-sinkron", {value: data}, function( data ) {
              $('#overlay').each(function(){
                $(this).fadeOut();
              });
            });*/
          }
        }).done(function(){
          console.log('done iki');
        });        
      });
    });

    $('.timepicker').each(function(){
      $(this).timepicker({
        showInputs: false
      })
    })

    $('.datepicker').each(function(){
      $(this).datepicker({
        autoclose: true,
        changeMonth: true,
        changeYear: true
      })
    })

    $('.updatenya').each(function(){
      var t = $(this),
          id = t.data('id');

      if(id == 1){
        $('#modal-success').modal('show')
      }
    })

    $('.generate-laporan').each(function(){
      var t = $(this),
          link = t.data('link'),
          form = t.closest('form'),
          select = form.find('select');

      t.click(function(){
        var target = $(this).data('link'),
            link = target+"/"+select.val();
            
        t.attr('href',link);
        return true;
      })
    })

    $('.form-sesi').each(function(){
      var t = $(this);

      t.click(function(){
        var jumlah = t.data('jumlah'),
            id = t.data('id'),
            fhari = $('#modal-sesi').find('.harine'),
            fujian = $('#modal-sesi').find('.ujiane'),
            sesi_id = $('#modal-sesi').find('input[name="sesi_id"]'),
            link = t.data('link'),
            form = t.find('form');

        sesi_id.val(id);
        fhari.find('option').remove();         
        fhari.append('<option value="">Pilih Hari</option>');
        for (var i = 1; i <= jumlah; i++) { 
          fhari.append('<option value="'+i+'">'+i+'</option>');
        }

        fhari.val('');
        fujian.val('');
      })
    })

    $('.form-sesi-edit').each(function(){
      var t = $(this);

      t.click(function(){
        var jumlah = t.data('jumlah'),
            id = t.data('id'),
            fhari = $('#modal-sesi').find('.harine'),
            fujian = $('#modal-sesi').find('.ujiane'),
            sesi_id = $('#modal-sesi').find('input[name="sesi_id"]'),
            link = t.data('link'),
            form = $('#modal-sesi').find('form'),
            hari = t.data('hari'),
            ujian = t.data('ujian');

        form.attr('action', link);
        sesi_id.val(id);
        fhari.val(hari).trigger('change');
        fujian.val(ujian).trigger('change');
      })
    });

    $('.form-sesi-pengaturan').each(function(){
      var t = $(this);

      t.click(function(){
        var x = $(this),
            modal = x.data('target'),
            id = x.data('id'),
            link = x.data('link'),
            key = (x.data('key') != '') ? x.data('key') : 'nama',
            value = x.data('value'),
            val = (typeof value !== 'undefined') ? value : [];
        
        $(modal).find('form').attr('action', link);
        $(modal).find('input[name="dsesi_id"]').val(id);
        $(modal).find('select[name="pengaturan"]').val(key).trigger('change');
        $(modal).find('select.valval').val(value).trigger('change');
      });
    })

    $('.form-waktu-edit').each(function(){
      var t = $(this);

      t.click(function(){
        var jumlah = t.data('jumlah'),
            id = t.data('id'),
            fhari = $('#modal-waktu').find('.harine'),
            fmulai = $('#modal-waktu').find('input[name="mulai"]'),
            fakhir = $('#modal-waktu').find('input[name="akhir"]'),
            sesi_id = $('#modal-waktu').find('input[name="sesi_id"]'),
            link = t.data('link'),
            form = $('#modal-waktu').find('form'),
            sesi = t.data('sesi'),
            mulai = t.data('mulai'),
            akhir = t.data('akhir');

        form.attr('action', link);
        sesi_id.val(id);
        fhari.val(sesi).trigger('change');
        fmulai.val(mulai);
        fakhir.val(akhir);
      })
    })

    $('.province_id').each(function(){
      var t = $(this);

      t.change(function(){
        $.post( "/dashboard/select", { 'prov': t.val() }, function(data){
          var data = $.parseJSON(data);
          var $el = $('.city_id');
          $el.find('option').remove();         
          $el.append('<option value="">Pilih Kabupaten</option>');
          $.each(data, function(key,value){
            $el.append('<option value="'+key+'">'+value+'</option>');
          });
        });
      });
    });

    $('.city_id').each(function(){
      var t = $(this);

      t.change(function(){
        $.post( "/dashboard/city", { 'city': t.val() }, function(data){
          var data = $.parseJSON(data);
          var $el = $('.district_id');
          $el.find('option').remove();
          $el.append('<option value="">Pilih Kecamatan</option>');
          $.each(data, function(key,value){
            $el.append('<option value="'+key+'">'+value+'</option>');            
          });
        });
      });
    });
    
    $('.btn-ujian').each(function(){
      var t = $(this),
          ujian = t.find('button.btn-success');

      ujian.click(function(){
        var link = t.data('link');
        window.location.href = link;
      });
    });
    
    $('.table-select').each(function(){
        var t = $(this),
            selectAll = t.find('.select-all'),
            item = t.find('.select-item');

        //column checkbox select all or cancel
        selectAll.click(function () {
            var checked = this.checked;
            item.each(function (index,item) {
                item.checked = checked;
            });
        });

        //check selected items
        item.click(function () {
            var checked = this.checked;
            console.log(checked);
            checkSelected();
        });

        //check is all selected
        function checkSelected() {
            var total = item.length,
                selecte = t.find('.select-item:checked'),
                len = selecte.length;

            console.log("total:"+total);
            console.log("len:"+len);
            if(len == total){
              selectAll.prop('checked',true);
            }else{
              selectAll.prop('checked',false);
            }
        }
    });
    
    $('.form-edit').each(function(){
      var t = $(this),
          target = t.data('target');

      t.click(function(){
        var id = t.data('id'),
            ujian = t.data('ujian'),
            content = t.data('content');

        $(target).find('input[name="soal_id"]').val(id);
        $(target).find('input[name="ujian_id"]').val(ujian);
        tinyMCE.activeEditor.setContent(content);
        if(content == ''){
          $(target).find('button[type="submit"]').text('Simpan');
        }else{
          $(target).find('button[type="submit"]').text('Save Changes');
        }
      });      
    });

    $('.district_id').each(function(){
      var t = $(this);

      t.change(function(){
        $.post( "/dashboard/district", { 'district': t.val() }, function(data){
          var data = $.parseJSON(data);
          var $el = $('.village_id');
          $el.find('option').remove();
          $el.append('<option value="">Pilih Desa</option>');
          $.each(data, function(key,value){
            $el.append('<option value="'+key+'">'+value+'</option>');            
          });
        });
      });
    });

    $('select.select2').each(function(){
      $(this).select2({
        placeholder: 'Pilih an option'
      })
    });

    $('input[type="checkbox"].icheck').each(function(){
      $(this).iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
      })
    })

    $('.cek-user').each(function(){
      var t = $(this);

      t.click(function(){
        var status = (t.is(':checked'))?'1':'0',
            tr = t.closest('tr'),
            kode = tr.attr('class');

        $.post( "/dashboard/user_status", { 'id': kode, 'status': status }, function(data){
          console.log(data);
        });
      });
    });
    
    $('.shared-link').each(function(){
      var t = $(this),
          target = t.data('target');

      t.click(function(){
        var h = t.data('id');

        $.post( "/dashboard/get_share", { 'id': h }, function(data){
          var obj = $.parseJSON(data);
          $(target).find('.link').find('a').text(obj.kode);
          $(target).find('.link').find('a').attr('href',obj.url);
        });
      });
    });

    $('.duplicate-link').each(function(){
      var t = $(this),
          target = t.data('target');

      t.click(function(){
        var h = t.data('id');

        $(target).find('input[name="ujian_id"]').val(h);
      });
    });

    $('.sesi-siswa').each(function(){
      var t = $(this);

      t.click(function(){
        var cek = '';
        $('body').find('table').find('tbody').find('input[type=checkbox]:not(.select-all):checked').each(function () {
          cek += $(this).val() + ",";
        });
        $('#modal-sesi').find('input[name="user_id"]').val(cek);
      })
    });
    
    $('.subscribe').each(function(){
      var t = $(this);

      t.click(function(){
        var h = t.data('id');

        $.post( "/dashboard/subscribe", { 'id': h }, function(data){
          if(data == '1'){
            t.removeClass('btn-primary');
            t.addClass('btn-warning');
            t.next().text('Unsubscribe');
          }else{
            t.addClass('btn-primary');
            t.removeClass('btn-warning');
            t.next().text('Subscribe');
          }
        });
      });
    });

    $('#tabelnya').on('click', '.btn-add', function(){
        var t = $(this),
            id = t.data('id'),
            to = t.data('new');

        $.post( "/dashboard/copy_soal", { 'id': id, 'ujian_id': to }, function(data){
          t.removeClass('btn-primary');
          t.addClass('btn-warning');
          t.text('Added');
        });
    });

    $('#modal-soal').on('hidden.bs.modal', function () {
      location.reload();
    })

    $('#tabelnya').each(function(){
      var t = $(this),
          source = t.data('source');

      t.DataTable({
        /*processing: true,
        serverSide: true,
        ajax: source,
        columnDefs: [
            { width: 5, targets: 0 }
        ],
        columns: [
          {data: 'id', name: 'id'},
          {data: 'soal', name: 'soal'},
          {data: 'ujiane', name: 'ujiane'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ]*/
        processing: true,
        serverSide: true,
        ajax: source,
        columns: [
            {data: 'id', name: 'soals.id'},
            {data: 'soal', name: 'soals.soal'},
            {data: 'level', name: 'level'},
            {data: 'ujiane.tags', name: 'ujiane.tags'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });
    });

    /*$('.generate').each(function(){
      var t = $(this);

      t.click(function(){
        $.ajax({
            type: "GET",
            url: '/dashboard/generate',
            beforeSend: function(data){      
                //t.find('.help-block.error').remove();
            },
            success: function (data) {
              $('#code').val(data);             
            },
            error: function(data){      
                //error message
            }
          });
          return false;
      });
    });*/

    $(document).on('click', '.getConfirm', function(e){
        e.preventDefault();
        var content = $('#modal-delete').find('.modal-content'),            
            teks = $('#modal-delete').find('.modal-body').find('p'),
            form = $('#modal-delete').find('form');

        if(form.length){
          form.attr('action',$(this).data('id'));
        }else{
          content.unwrap('<form></form>')
          content.wrap('<form id="formDelete" method="POST" action="'+$(this).data('id')+'"></form>');        
        }
        teks.html('Yakin akan menghapus '+$(this).data('title')+' <b>'+$(this).data('name')+'</b>');
    });

    $('.btn-tab').each(function(){
      var t = $(this),
          form = $('#tambah');

      t.click(function(){
        var name = t.data('title'),
            button = form.find('button[type="submit"]'),
            kode = t.data('id');
        form.find('h3').text('Form '+name+' Soal');        
        if(name == 'Edit'){
          button.text('Update Changes');
          $.ajax({
            type: "GET",
            url: '/dashboard/get_soal/'+kode,
            beforeSend: function(data){      
                //t.find('.help-block.error').remove();
            },
            success: function (data) {
              var data = jQuery.parseJSON(data);
              if(data.status == 'success'){                
                form.find('#soal').setContent('<p>This is my new content!</p>');
                tunyMCE();
              }              
            },
            error: function(data){      
                //error message
            }
          });
        }else{
          button.text('Save');
        }
      });
    });

    $('.nav-tabs').each(function(){
      var t = $(this),
          w = t.find('a');

      var hash = window.location.hash;
      if(hash != ''){        
        $('.nav-tabs a[href="'+hash+'"]').tab('show');
      }    

      w.click(function(){
        var ref = $(this).attr('href');
        window.location.hash = ref;
      });
    });

    $('.tab-content').each(function(){
      var t = $(this),
          w = t.find('a.btn-tab');

      var hash = window.location.hash;
      if(hash != ''){        
        $('.tab-content a[href="'+hash+'"]').tab('show');
      }    

      w.click(function(){
        var ref = $(this).attr('href');
        window.location.hash = ref;        
        $('.nav-tabs').find('li').removeClass('active');
        $('.nav-tabs').find('a[href$="'+ref+'"]').closest('li').addClass('active');
      });
    });

    function tunyMCE(){
      /*tinymce.init({
        selector : "textarea.editor",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste","tiny_mce_wiris"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | tiny_mce_wiris_formulaEditor",
        image_advtab: true ,
        menubar:false,
      });*/
      var editor_config = {
      path_absolute : "/",
      selector: "textarea.editor",
      plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
      toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
      menubar:false,
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
        
        var cmsURL = editor_config.path_absolute + 'dashboard/laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);
    }tunyMCE();
    
    $(document).ready(function(){
        init();
        capital();
    });
})();

jQuery.fn.extend({
  errMessage: function (r) {
    var el = $(this);
    el.find('.form-group').each(function(){
      $(this).removeClass('has-error');
    })
    el.find('.help-block.error').remove();
    $.each(r, function (name, msg) {
      var e = el.find('[name="' + name + '"]').not(':disabled'),
              em = el.find('[name="' + name + '[]"]'),
              bs = e.parents('.bootstrap-select'),
              bsm = em.parents('.bootstrap-select');
      if (e.length) {        
        if (bs.length) {          
          bs.errSpan(msg);
        } else {          
          e.errSpan(msg);
        }
      } else if (em.length) {        
        if (bsm.length) {          
          bsm.errSpan(msg);
        } else {          
          em.errSpan(msg);
        }
      }
    });
  },
  errMessageReset: function () {      
    $(this).find('.form-group').each(function (name, msg) {
      var el = $(this);
      el.removeClass('has-error');
      el.find('.help-block.error').remove();
    });
  },
  errSpan: function (msg) {   
    var m = typeof msg === 'string' ? msg : msg.join('<br />');
    $(this)
          .parents('.form-group')
          .append('<span class="help-block error">' + m + '</span>')
          .addClass('has-error');
  }
});
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJtYWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuXHJcbiAgICBmdW5jdGlvbiBpbml0KCl7XHJcbiAgICAgICAgalF1ZXJ5KCdpbWcuc3ZnJykuZWFjaChmdW5jdGlvbihpKXtcclxuICAgICAgICAgICAgdmFyICRpbWcgPSBqUXVlcnkodGhpcyk7XHJcbiAgICAgICAgICAgIHZhciBpbWdJRCA9ICRpbWcuYXR0cignaWQnKTtcclxuICAgICAgICAgICAgdmFyIGltZ0NsYXNzID0gJGltZy5hdHRyKCdjbGFzcycpO1xyXG4gICAgICAgICAgICB2YXIgaW1nVVJMID0gJGltZy5hdHRyKCdzcmMnKTtcclxuXHJcbiAgICAgICAgICAgIGpRdWVyeS5nZXQoaW1nVVJMLCBmdW5jdGlvbihkYXRhKSB7XHJcbiAgICAgICAgICAgICAgICAvLyBHZXQgdGhlIFNWRyB0YWcsIGlnbm9yZSB0aGUgcmVzdFxyXG4gICAgICAgICAgICAgICAgdmFyICRzdmcgPSBqUXVlcnkoZGF0YSkuZmluZCgnc3ZnJyk7XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gQWRkIHJlcGxhY2VkIGltYWdlJ3MgSUQgdG8gdGhlIG5ldyBTVkdcclxuICAgICAgICAgICAgICAgIGlmKHR5cGVvZiBpbWdJRCAhPT0gJ3VuZGVmaW5lZCcpIHtcclxuICAgICAgICAgICAgICAgICAgICAkc3ZnID0gJHN2Zy5hdHRyKCdpZCcsIGltZ0lEKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIC8vIEFkZCByZXBsYWNlZCBpbWFnZSdzIGNsYXNzZXMgdG8gdGhlIG5ldyBTVkdcclxuICAgICAgICAgICAgICAgIGlmKHR5cGVvZiBpbWdDbGFzcyAhPT0gJ3VuZGVmaW5lZCcpIHtcclxuICAgICAgICAgICAgICAgICAgICAkc3ZnID0gJHN2Zy5hdHRyKCdjbGFzcycsIGltZ0NsYXNzKycgcmVwbGFjZWQtc3ZnJyk7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gUmVtb3ZlIGFueSBpbnZhbGlkIFhNTCB0YWdzIGFzIHBlciBodHRwOi8vdmFsaWRhdG9yLnczLm9yZ1xyXG4gICAgICAgICAgICAgICAgJHN2ZyA9ICRzdmcucmVtb3ZlQXR0cigneG1sbnM6YScpO1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFJlcGxhY2UgaW1hZ2Ugd2l0aCBuZXcgU1ZHXHJcbiAgICAgICAgICAgICAgICAkaW1nLnJlcGxhY2VXaXRoKCRzdmcpO1xyXG5cclxuICAgICAgICAgICAgfSwgJ3htbCcpO1xyXG5cclxuICAgICAgICB9KTtcclxuICAgICAgICBzZXRUaW1lb3V0KGZ1bmMsNTAwKTtcclxuICAgIH1cclxuICAgIGZ1bmN0aW9uIGZ1bmMoKXtcclxuICAgICAgICAkKCdmb290ZXInKS5maW5kKCdoMycpLmVhY2goZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgJCh0aGlzKS5jbGljayhmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS50b2dnbGVDbGFzcygnb3BlbicpO1xyXG5cclxuICAgICAgICAgICAgfSlcclxuICAgICAgICB9KVxyXG4gICAgICAgIFxyXG5cclxuICAgICAgICAkKCdbZGF0YS10b2dnbGU9XCJ0b29sdGlwXCJdJykudG9vbHRpcCgpO1xyXG5cclxuICAgICAgICAvL3RhYmxlIHdpdGggY2hlY2tib3hzY3JpcHRcclxuICAgICAgICAkKCdpbnB1dFtuYW1lPVwiY2hlY2thbGxcIl0nKS5lYWNoKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICB2YXIgdCA9ICQodGhpcykuY2xvc2VzdCgndGFibGUnKSxcclxuICAgICAgICAgICAgICBjaGsgPSB0LmZpbmQoJ2lucHV0OmNoZWNrYm94Om5vdChbbmFtZT1cImNoZWNrYWxsXCJdKScpLFxyXG4gICAgICAgICAgICAgIGNoa2FsbCA9ICQodGhpcyksXHJcbiAgICAgICAgICAgICAgZHQgPSAkKHRoaXMpLmRhdGEoJ3RhYmxlJyksXHJcbiAgICAgICAgICAgICAgYnVsayA9ICQoJ3NlbGVjdC5idWxrW2RhdGEtdGFibGU9XCInK2R0KydcIl0nKTtcclxuXHJcblxyXG4gICAgICAgICAgXHJcblxyXG5cclxuICAgICAgICAgIGZ1bmN0aW9uIHRyY2hlY2soKXtcclxuICAgICAgICAgICAgY2hrLmVhY2goZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICB2YXIgdHIgPSAkKHRoaXMpLmNsb3Nlc3QoJ3RyJyk7XHJcbiAgICAgICAgICAgICAgaWYoJCh0aGlzKS5pcygnOmNoZWNrZWQnKSkge1xyXG4gICAgICAgICAgICAgICAgICB0ci5hZGRDbGFzcygnY2hlY2tlZCcpO1xyXG4gICAgICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICAgICAgIHRyLnJlbW92ZUNsYXNzKCdjaGVja2VkJyk7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KVxyXG4gICAgICAgICAgfVxyXG5cclxuICAgICAgICAgIGZ1bmN0aW9uIGNoZWNrKCl7XHJcbiAgICAgICAgICAgIHZhciBjID0gY2hrLmxlbmd0aCxcclxuICAgICAgICAgICAgICAgIGNoZWNrZWQgPSB0LmZpbmQoJ2lucHV0OmNoZWNrYm94Om5vdChbbmFtZT1cImNoZWNrYWxsXCJdKTpjaGVja2VkJykubGVuZ3RoO1xyXG4gICAgICAgICAgICBjb25zb2xlLmxvZyhjK1wiLVwiK2NoZWNrZWQpO1xyXG4gICAgICAgICAgICBpZihjID09IGNoZWNrZWQpe1xyXG4gICAgICAgICAgICAgIGNoa2FsbC5wcm9wKCdjaGVja2VkJyx0cnVlKTtcclxuICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgY2hrYWxsLnByb3AoJ2NoZWNrZWQnLGZhbHNlKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG5cclxuICAgICAgICAgIGNoa2FsbC5jaGFuZ2UoZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgaWYoJCh0aGlzKS5pcygnOmNoZWNrZWQnKSkge1xyXG4gICAgICAgICAgICAgICAgY2hrLnByb3AoJ2NoZWNrZWQnLCB0cnVlKTtcclxuICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgIGNoay5wcm9wKCdjaGVja2VkJywgZmFsc2UpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIHRyY2hlY2soKTtcclxuICAgICAgICAgIH0pXHJcblxyXG5cclxuICAgICAgICAgIGNoay5jaGFuZ2UoZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgdHJjaGVjaygpO2NoZWNrKCk7XHJcbiAgICAgICAgICB9KVxyXG5cclxuICAgICAgICB9KVxyXG5cclxuICAgICAgICBcclxuXHJcbiAgICAgICAgdmFyIGNjID0gJCgnLmNvdW50LWlucHV0Jyk7XHJcbiAgICAgICAgY2MuZWFjaChmdW5jdGlvbigpIHtcclxuICAgICAgICAgIHZhciB0ID0gJCh0aGlzKSxcclxuICAgICAgICAgICAgdGV4dF9tYXggPSB0LmZpbmQoJy5tYXgtY291bnQnKS50ZXh0KCk7XHJcbiAgICAgICAgICB0LmZpbmQoJ2lucHV0LCB0ZXh0YXJlYScpLmF0dHIoJ21heGxlbmd0aCcscGFyc2VJbnQodGV4dF9tYXgpKTtcclxuICAgICAgICAgIHQuZmluZCgnaW5wdXQsIHRleHRhcmVhJykua2V5dXAoZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIHZhciB0ZXh0X2xlbmd0aCA9ICQodGhpcykudmFsKCkubGVuZ3RoO1xyXG4gICAgICAgICAgICB2YXIgdGV4dF9yZW1haW5pbmcgPSB0ZXh0X21heCAtIHRleHRfbGVuZ3RoO1xyXG4gICAgICAgICAgICB0LmZpbmQoJy5tYXgtY291bnQnKS5odG1sKHRleHRfcmVtYWluaW5nKTtcclxuICAgICAgICAgIH0pO1xyXG4gICAgICAgIH0pXHJcblxyXG4gICAgICAgICQoJy5zdGF0dXMtZGV0YWlsIC50aXRsZScpLmNsaWNrKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICB2YXIgdCA9ICQodGhpcyksXHJcbiAgICAgICAgICAgICAgY29uID0gdC5jbG9zZXN0KCcuaXRlbScpLmZpbmQoJy5jb24nKTtcclxuXHJcbiAgICAgICAgICAkKCcuc3RhdHVzLWRldGFpbCAudGl0bGUnKS5ub3QodCkucmVtb3ZlQ2xhc3MoJ3Nob3cnKTtcclxuICAgICAgICAgICQoJy5zdGF0dXMtZGV0YWlsIC5jb24nKS5ub3QodCkuc2xpZGVVcCgnc2xvdycpO1xyXG4gICAgICAgICAgdC50b2dnbGVDbGFzcygnc2hvdycpO1xyXG4gICAgICAgICAgY29uLnNsaWRlVG9nZ2xlKCdzbG93Jyk7XHJcbiAgICAgICAgfSlcclxuXHJcbiAgICAgICAgJCgnLnVybC1pbnB1dCcpLmtleXVwKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICB2YXIgdmFsID0gJCh0aGlzKS52YWwoKSxcclxuICAgICAgICAgICAgICB0eHQgPSAkKCcudXJsIHNwYW4nKTtcclxuXHJcbiAgICAgICAgICB0eHQudGV4dCh2YWwrXCIvXCIpO1xyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICAkKCcuZmlsZSBpbnB1dFt0eXBlPVwiZmlsZVwiXScpLmVhY2goZnVuY3Rpb24oKXtcclxuICAgICAgICAgIHZhciB0ID0gJCh0aGlzKSxcclxuICAgICAgICAgICAgICBidG4gPSB0LnNpYmxpbmdzKCdkaXYnKTtcclxuXHJcbiAgICAgICAgICB0LmNoYW5nZShmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICB2YXIgZmlsZW5hbWUgPSAkKHRoaXMpLnZhbCgpLnNwbGl0KCdcXFxcJykucG9wKCk7XHJcbiAgICAgICAgICAgIGJ0bi5odG1sKCc8aSBjbGFzcz1cImZhIGZhLWZpbGUtbyBtcjEwXCI+PC9pPiAnK2ZpbGVuYW1lKTtcclxuICAgICAgICAgIH0pXHJcbiAgICAgICAgfSlcclxuXHJcbiAgICAgICAgXHJcblxyXG4gICAgICAgIFxyXG5cclxuICAgICAgICAvL2lucHV0IG51bWJlclxyXG4gICAgICAgICQoXCJib2R5XCIpLmZpbmQoJ2lucHV0Lm51bWJlcicpLmtleWRvd24oZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgLy8gQWxsb3c6IGJhY2tzcGFjZSwgZGVsZXRlLCB0YWIsIGVzY2FwZSwgZW50ZXIgYW5kIC5cclxuICAgICAgICAgICAgY29uc29sZS5sb2coZS5rZXlDb2RlKTtcclxuICAgICAgICAgICAgaWYgKCQuaW5BcnJheShlLmtleUNvZGUsIFs0NiwgOCwgOSwgMjcsIDEzLCAxMTAsIDE5MF0pICE9PSAtMSB8fFxyXG4gICAgICAgICAgICAgICAgLy8gQWxsb3c6IEN0cmwrQSwgQ29tbWFuZCtBXHJcbiAgICAgICAgICAgICAgICAoZS5rZXlDb2RlID09PSA2NSAmJiAoZS5jdHJsS2V5ID09PSB0cnVlIHx8IGUubWV0YUtleSA9PT0gdHJ1ZSkpIHx8XHJcbiAgICAgICAgICAgICAgICAvLyBBbGxvdzogaG9tZSwgZW5kLCBsZWZ0LCByaWdodCwgZG93biwgdXBcclxuICAgICAgICAgICAgICAgIChlLmtleUNvZGUgPj0gMzUgJiYgZS5rZXlDb2RlIDw9IDQwKSkge1xyXG4gICAgICAgICAgICAgICAgLy8gbGV0IGl0IGhhcHBlbiwgZG9uJ3QgZG8gYW55dGhpbmdcclxuICAgICAgICAgICAgICAgIHJldHVybjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAvLyBFbnN1cmUgdGhhdCBpdCBpcyBhIG51bWJlciBhbmQgc3RvcCB0aGUga2V5cHJlc3NcclxuICAgICAgICAgICAgaWYgKChlLnNoaWZ0S2V5IHx8IChlLmtleUNvZGUgPCA0OCB8fCBlLmtleUNvZGUgPiA1NykpICYmIChlLmtleUNvZGUgPCA5NiB8fCBlLmtleUNvZGUgPiAxMDUpKSB7XHJcbiAgICAgICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgXHJcbiAgICAgICAgJCgnc2VsZWN0JykuYWRkQ2xhc3MoJ3NlbGVjdCcpLnNlbGVjdHBpY2tlcih7XHJcbiAgICAgICAgICAgIHN0eWxlOiAnc2VsZWN0LWNvbnRyb2wnLFxyXG4gICAgICAgICAgICBzaXplOiA0XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIFxyXG5cclxuICAgICAgICBcclxuXHJcbiAgICAgICAgXHJcblxyXG5cclxuICAgICAgICBcclxuICAgICAgICBcclxuXHJcbiAgICAgICAgXHJcbiAgICAgICAgXHJcblxyXG4gICAgICAgICQoJ3RleHRhcmVhLnJpY2gtdGV4dCcpLmVhY2goZnVuY3Rpb24oKXtcclxuICAgICAgICAgIHZhciBfdG9rZW4gPSAkKHRoaXMpLnBhcmVudHMoJ2Zvcm0nKS5maW5kKCdbbmFtZT1cIl90b2tlblwiXScpLnZhbCgpO1xyXG4gICAgICAgICAgdGlueW1jZS5pbml0KHtcclxuICAgICAgICAgICAgc2VsZWN0b3I6ICd0ZXh0YXJlYS5yaWNoLXRleHQnLFxyXG4gICAgICAgICAgICBoZWlnaHQ6IDUwMCxcclxuICAgICAgICAgICAgbWVudWJhcjogZmFsc2UsXHJcbiAgICAgICAgICAgIHBsdWdpbnM6IFtcclxuICAgICAgICAgICAgICAnYWR2bGlzdCBhdXRvbGluayBsaXN0cyBsaW5rIGltYWdlIGNoYXJtYXAgcHJpbnQgcHJldmlldyBhbmNob3IgdGV4dGNvbG9yIHNwb2lsZXInLFxyXG4gICAgICAgICAgICAgICdzZWFyY2hyZXBsYWNlIHZpc3VhbGJsb2NrcyBjb2RlIGZ1bGxzY3JlZW4nLFxyXG4gICAgICAgICAgICAgICdpbnNlcnRkYXRldGltZSBtZWRpYSB0YWJsZSBjb250ZXh0bWVudSBwYXN0ZSBjb2RlIGZpbGVtYW5hZ2VyJ1xyXG4gICAgICAgICAgICBdLFxyXG4gICAgICAgICAgICB0b29sYmFyMTogJ2JvbGQgaXRhbGljIHVuZGVybGluZSB8IHNwb2lsZXItYWRkIHNwb2lsZXItcmVtb3ZlIHwgYWxpZ25sZWZ0IGFsaWduY2VudGVyIGFsaWducmlnaHQgYWxpZ25qdXN0aWZ5IHwgYnVsbGlzdCBudW1saXN0JyxcclxuICAgICAgICAgICAgaW1hZ2VfYWR2dGFiOiB0cnVlICxcclxuICAgICAgICAgICAgY29udGVudF9jc3M6ICcvL3d3dy50aW55bWNlLmNvbS9jc3MvY29kZXBlbi5taW4uY3NzJyxcclxuICAgICAgICAgICAgcmVsYXRpdmVfdXJsczogZmFsc2UsXHJcbiAgICAgICAgICAgIGZpbGVtYW5hZ2VyX3RpdGxlOlwiRmlsZW1hbmFnZXJcIiAsXHJcbiAgICAgICAgICAgIGV4dGVybmFsX2ZpbGVtYW5hZ2VyX3BhdGg6IFwiL3BsdWdpbnMvdGlueW1jZS9qcy90aW55bWNlL3BsdWdpbnMvZmlsZW1hbmFnZXIvXCJcclxuICAgICAgICAgIH0pO1xyXG4gICAgICAgIH0pO1xyXG5cclxuICAgIH1cclxuICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgaW5pdCgpO1xyXG5cclxuICAgIH0pXHJcblxyXG59KSgpOyJdLCJmaWxlIjoibWFpbi5qcyIsInNvdXJjZVJvb3QiOiIvc291cmNlLyJ9

//# sourceMappingURL=main.js.map