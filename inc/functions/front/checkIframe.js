function checkIframeLoaded(iframe) {
    // Vérifier si l'iframe est chargée avec succès
    try {
      const doc = iframe.contentDocument || iframe.contentWindow.document;
      return !!doc;
    } catch (e) {
      // Si une erreur s'est produite, cela signifie que l'iframe a été bloquée
      return false;
    }
}
