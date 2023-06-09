const ctx = document.getElementById('myChart');
const labelButton = document.getElementById('label');

    let urlsDateLabel = myShortUrlsArray.map(url => {

        let myUrlsDateFormat = url.created_at.replaceAll('-', '/');

        let myUrlsClics = url.clic;

        let myUrlsDate = new Date(myUrlsDateFormat);
        
        let mois = myUrlsDate.getMonth() + 1;
        mois = mois.toString().length === 1 ? '0' + mois : mois;
        let jour = myUrlsDate.getDate();
        jour = jour.toString().length === 1 ? '0' + jour : jour;

        let heure = myUrlsDate.getHours();
        let minute = myUrlsDate.getMinutes();

        let moisJour = jour + '/' + mois;
        let heureMinute = heure + ':' + minute;

        return [{moisJour, heureMinute, myUrlsClics}];
  })

    function formatDate(arr) {
        const formattedDate = arr.map(([date]) => {
            let today = new Date().toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit' });
            let currentDay = date.moisJour;

            if (today === currentDay) {
            return date.heureMinute;
            } else {
            return `${date.moisJour} ${date.heureMinute}`;
            }
        });

        const myClics = arr.map(([url]) => url.myUrlsClics)

        return {formattedDate, myClics};
    }

    function extractHostname(url) {
        let hostname = '';
      
        // find & remove protocol (http, ftp, etc.) and get hostname
        if (url.indexOf('://') > -1) {
          hostname = url.split('/')[2];
        } else {
          hostname = url.split('/')[0];
        }
      
        // remove port number
        hostname = hostname.split(':')[0];
      
        // remove suffix (.com, .org, etc.)
        hostname = hostname.replace(/\.[^/.]+$/, "");
      
        return hostname;
      }

      
    let labelsUrl = formatDate(urlsDateLabel);
    let labelHostName = myShortUrlsArray.map(urlInfo => extractHostname('https://' + urlInfo.original_url));

    function switchLabel(datas, label) {
        console.log(chart.data.labels)
        chart.data.labels = datas
        labelButton.textContent = label
        chart.update();
    }

    labelButton.addEventListener('click', () => {
        if(labelButton.textContent === 'Date'){
            switchLabel(labelsUrl.formattedDate, 'Nom');
        } else if(labelButton.textContent === 'Nom'){
            switchLabel(labelHostName, 'Date');
        }
      });

    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelHostName,
            datasets: [{
                label: 'Afficher',
                data: labelsUrl.myClics,
                borderWidth: 3,
            }],
        },
        options: {
            scales: {
                y: {
                beginAtZero: true
                }
            },
            backgroundColor: 'rgb(27 36 88)',
            borderColor: 'rgb(22 160 133)',
    }
});