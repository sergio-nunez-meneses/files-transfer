function ajaxResponse() {
  console.log(this.responseText); // just for debugging
  const RESPONSE = JSON.parse(this.responseText);
  console.log(RESPONSE);
  
  if (RESPONSE['form'] === 'transfer-form') {
    document.getElementById('demo1').innerHTML = RESPONSE['errors'];
    document.getElementById('demo2').innerHTML = RESPONSE['subject'];
    document.getElementById('demo3').innerHTML = RESPONSE['messages'];
  } else if (RESPONSE['form'] === 'download-form') {
    document.getElementById('demo1').innerHTML = RESPONSE['message'];
  }
}

function ajaxQuery(form) {
  let xhr = new XMLHttpRequest();

  xhr.open('POST', 'actions/ajaxQuery.php');
  xhr.send(form);

  xhr.onload = ajaxResponse;
}

function query(queryName, formElement) {
  let form = new FormData(formElement);

  form.append('query', queryName);

  return form;
}
