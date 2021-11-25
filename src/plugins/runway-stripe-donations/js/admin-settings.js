jQuery(function ($) {

  function uuid() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
      return v.toString(16);
    });
  }

  function addNewTemplate(values) {
    var el = $(
      '<tr class="template__name"><th scope="row">Template name</th><td><input size="40" /></td></tr>' +
      '<tr class="template__body"><th scope="row">Template body</th><td><textarea></textarea><p>Documentation: <a href="?page=runway-stripe-donations&amp;tab=documentation#form-templates">Learn about how these templates are rendered</a></p></td></tr>' +
      '<tr class="template__actions"><th scope="row"></th><td><a class="template__remove" href="javascript:void(0);">Remove</a></td></tr>'
    );
    $('#form-templates').append(el);

    el.find('input')
      .val(values.name)
      .data('guid', values.guid);

    var ta = el.find('textarea');
    var bodyTr = ta.closest('.template__body').get(0);
    ta.val(values.body);

    var editor = ace.edit(ta.get(0));
    editor.getSession().setMode("ace/mode/html");
    editor.getSession().setTabSize(2);
    editor.getSession().setUseSoftTabs(true);

    bodyTr.editor = editor;

    updateNoTemplateDisplay();
  }

  function updateNoTemplateDisplay() {
    $('#no-templates').toggle(!$('#form-templates').find('tr').length);
  }

  function getTemplatesAsJson() {
    return JSON.stringify($('#form-templates .template__name').map(function () {
      return {
        guid: $(this).find('input').data('guid'),
        name: $(this).find('input').val(),
        body: $(this).next().get(0).editor.getValue()
      }
    }).toArray());
  }

  function loadTemplatesFromJson(json) {
    var templates = JSON.parse(json);
    jQuery(templates).each(function () {
      addNewTemplate(this);
    });
  }

  if($('#form-templates').length) {
    $('#add-template').click(function () {
      addNewTemplate({
        guid: uuid(),
        name: 'New template',
        body: '<div>\n  Blank template\n</div>'
      });
    });

    $('#form-templates').on('click', '.template__remove', function () {
      var tr = $(this).closest('tr');
      tr.prev().remove();
      tr.prev().remove();
      tr.remove();
      updateNoTemplateDisplay();
    });

    $('#submit').click(function () {
      $('#runway_stripe_form_templates').val(getTemplatesAsJson());
    });

    loadTemplatesFromJson($('#runway_stripe_form_templates').val() || '[]');
  }

  $('.runway-stripe-hidden-details-toggle').click(function () {
    let pre = $(this).siblings('.runway-stripe-hidden-details');
    pre.toggle();
    $(this).text(pre.is(':visible') ? 'Hide details' : 'Show details');
  });
});
