// 폼청소
function clearFields(v) {
  var target = document.getElementById(v);
  var em = target.elements;
  target.reset();
  for (var i = 0; i < em.length; i++) {
    if (em[i].type == 'text') em[i].value = '';
    if (em[i].type == 'checkbox') em[i].checked = false;
    if (em[i].type == 'radio') em[i].checked = false;
    if (em[i].type == 'select-one') em[i].options[0].selected = true;
    if (em[i].type == 'textarea') em[i].value = '';
  }
  return;
}
