(function() {
  var Application;

  Application = window;

  Application.ajaxEnableQueueCount = 0;

  Application.modalQueue = [];

  Application.checkRequired = function() {
    var errorList, requiredItens;
    errorList = [];
    requiredItens = $('.required');
    requiredItens.each(function(index, value) {
      var elem;
      elem = $(value);
      if (elem.val() === '') {
        errorList.push(elem.attr('title'));
      }
      return null;
    });
    if (errorList.length > 0) {
      Application.showMessage('alert', errorList);
      return false;
    }
    return true;
  };

  Application.disableElements = function() {
    Application.ajaxEnableQueueCount++;
    $('.disable-on-submit').attr('disabled', 'disabled');
    return null;
  };

  Application.enableElements = function() {
    if (Application.ajaxEnableQueueCount > 0) {
      Application.ajaxEnableQueueCount--;
      if (Application.ajaxEnableQueueCount === 0) {
        $('.disable-on-submit').removeAttr('disabled');
      }
    }
    return null;
  };

  Application.clearMessages = function() {
    $('.box-alerta').empty();
    return null;
  };

  Application.escapeHtml = function(text) {
    return text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  };

  Application.showMessage = function(type, message) {
    var canHide, fnFadwOut, head, instance, isHiding, item, messageList, style, template, _i, _len;
    switch (type.toLowerCase()) {
      case 'alert':
        style = 'alert-block';
        head = 'Aviso!';
        break;
      case 'success':
        style = 'alert-success';
        head = 'Sucesso!';
        break;
      case 'info':
        style = 'alert-info';
        head = 'Informações!';
        break;
      default:
        style = 'alert-error';
        head = 'Erro!';
    }
    if (message instanceof Array) {
      messageList = message;
      message = '<ul>';
      for (_i = 0, _len = messageList.length; _i < _len; _i++) {
        item = messageList[_i];
        message += '<li>' + this.escapeHtml(item) + '</li>';
      }
      message += '</ul>';
    }
    template = '<div class="alert [STYLE]" style="display:none"><a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">[HEAD]</h4>[MESSAGE]</div>';
    instance = $(template.replace('[STYLE]', style).replace('[HEAD]', head).replace('[MESSAGE]', message));
    $('.box-alerta').append(instance);
    instance.slideDown(400);
    instance.bind('close', function() {
      instance.slideUp();
      return false;
    });
    instance.bind('click', function() {
      instance.trigger('close');
      return false;
    });
    canHide = true;
    isHiding = false;
    fnFadwOut = function() {
      return setTimeout(function() {
        if (canHide) {
          isHiding = true;
          instance.fadeOut(1000, function() {
            if (canHide) {
              return $(this).remove();
            }
          });
        }
        return null;
      }, 5000);
    };
    fnFadwOut();
    instance.hover(function() {
      canHide = false;
      if (isHiding) {
        isHiding = false;
        return $(this).stop().animate({
          opacity: 100
        });
      }
    }, function() {
      canHide = true;
      return fnFadwOut();
    });
    return null;
  };

  Application.showModal = function(fluid, contentHtml) {
    var count, popup, popupTemplate;
    contentHtml = contentHtml === null || contentHtml === void 0 ? '' : contentHtml;
    fluid = fluid === true;
    popupTemplate = '<div class="__modal-parent  ' + (fluid ? 'modalFluid' : 'modal') + ' hide" >' + '	<div class="row-fluid xsob" >' + '		<button type="button" class="close ' + (fluid ? 'xfecharFluid' : 'xfechar') + '" onclick="closeModal()">×</button>' + '	</div>' + '	<div class="modal-body"></div>' + '</div>';
    popup = $(popupTemplate);
    if (contentHtml !== '') {
      popup.find('.modal-body').append(contentHtml);
    }
    Application.modalQueue.push(popup);
    count = Application.modalQueue.length;
    if (count > 1) {
      Application.modalQueue[count - 2].find('.modal-body').prepend('<div class="modal-backdrop in" ></div>');
    }
    $('BODY *').attr('tabindex', '-1');
    popup.modal({
      keyboard: false
    });
    popup.focus();
    popup.on('hidden', function() {
      popup.remove();
      Application.modalQueue.pop();
      count = Application.modalQueue.length;
      if (count > 0) {
        Application.modalQueue[count - 1].find('*').attr('tabindex', '');
        return Application.modalQueue[count - 1].find('.modal-backdrop').remove();
      } else {
        return $('BODY *').attr('tabindex', '');
      }
    });
    return popup;
  };

  Application.closeModal = function() {
    var count;
    count = Application.modalQueue.length;
    if (count > 0) {
      Application.modalQueue[count - 1].modal('hide');
    }
    return null;
  };

  Application.alignModal = function() {
    $('.modalFluid').css({
      'marginLeft': -($('.modalFluid').width() / 2)
    }).find('.modal-body').css({
      'max-height': $(window).height() - 180
    }).end().css({
      'marginTop': -($('.modalFluid').outerHeight() / 2)
    });
    return null;
  };

  $(window).resize(function() {
    if (!$(document).width() < 800) {
      Application.alignModal();
    }
    return null;
  });

  $(document).keyup(function(e) {
    if (e.keyCode === 27) {
      Application.closeModal();
    }
    return null;
  });

}).call(this);