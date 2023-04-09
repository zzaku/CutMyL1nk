const ctx = document.getElementById('myChart');

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

    let labelsUrl = formatDate(urlsDateLabel);

    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: labelsUrl.formattedDate,
        datasets: [{
            label: '# of Votes',
            data: labelsUrl.myClics,
            borderWidth: 3
        }]
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