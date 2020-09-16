function ajaxResponse() {
  console.log(this.responseText); // just for debugging

  if (isJSON(this.responseText) === true) {
    const RESPONSE = JSON.parse(this.responseText);
    console.log(RESPONSE); // just for debugging

    document.getElementById('mailContainer').classList.remove('d-none');

    if (RESPONSE['form'] === 'transfer-form') {
      document.getElementById('errors').innerHTML = RESPONSE['errors'];
      document.getElementById('subject').innerHTML = RESPONSE['subject'];
      document.getElementById('messages').innerHTML = RESPONSE['messages'];
    } else if (RESPONSE['form'] === 'download-form') {
      document.getElementById('messages').innerHTML = RESPONSE['message'];
    }
  } else {
    console.log('Syntax error');
  }
}

function ajax(form) {
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

function isJSON(responseText)
{
  console.log(responseText);
  if (typeof responseText !== 'string') {
    return false;
  } else if (responseText.charAt(0) !== '{') {
    return false;
  }
  return true;
}

function transferResponse() {
  //
}

function downloadResponse() {
  //
}
