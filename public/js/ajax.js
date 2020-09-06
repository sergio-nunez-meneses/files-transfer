function ajaxResponse() {
  console.log(this.responseText); // just for debugging
  const RESPONSE = JSON.parse(this.responseText);
  console.log(RESPONSE); // just for debugging

  document.getElementById('mailContainer').classList.remove('hidden');

  if (RESPONSE['form'] === 'transfer-form') {
    document.getElementById('errors').innerHTML = RESPONSE['errors'];
    document.getElementById('subject').innerHTML = RESPONSE['subject'];
    document.getElementById('messages').innerHTML = RESPONSE['messages'];
  } else if (RESPONSE['form'] === 'download-form') {
    document.getElementById('messages').innerHTML = RESPONSE['message'];
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
