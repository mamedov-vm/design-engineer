export default {
  toClipboard(value) {

    copyTextToClipboard(value);

    function fallbackCopyTextToClipboard(text) {
      let textArea = document.createElement('textarea');
      textArea.value = text;
      document.body.appendChild(textArea);
      textArea.select();

      try {
        let successful = document.execCommand('copy');
        let msg = successful ? 'Код скопирован в буфер обмена' : 'Не удалось скопировать код';
        window.app.newNoty('Уведомление|' + msg);
      } catch (err) {
        window.app.newNoty('Уведомление|Не удалось скопировать код');
      }

      document.body.removeChild(textArea);
    }

    function copyTextToClipboard(text) {
      if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
      }
      navigator.clipboard.writeText(text).then(
          function () {
            window.app.newNoty('Уведомление|Код скопирован в буфер обмена');
          },
          function () {
            window.app.newNoty('Уведомление|Не удалось скопировать код');
          },
      );
    }
  },
}