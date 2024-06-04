fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
 .then(response => response.json())
 .then(provinces => {
    const originSelect = document.getElementById('origin');
    const destinationSelect = document.getElementById('destination');

    provinces.forEach(province => {
      const option = document.createElement('option');
      option.value = province.id;
      option.textContent = province.name;
      originSelect.appendChild(option);
      destinationSelect.appendChild(option.cloneNode(true));
    });

    document.getElementById('tombol-rute').addEventListener('click', () => {
      const additionalRoute = document.getElementById('additional-route');
      additionalRoute.style.display = 'block';

      const selectedOriginProvinceId = originSelect.value;
      const selectedDestinationProvinceId = destinationSelect.value;

      fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selectedOriginProvinceId}.json`)
       .then(response => response.json())
       .then(originRegencies => {
          const originAdditionalSelect = document.getElementById('origin-additional');

          originRegencies.forEach(regency => {
            const option = document.createElement('option');
            option.value = regency.id;
            option.textContent = regency.name;
            originAdditionalSelect.appendChild(option);
          });
        })
       .catch(error => console.error('Error fetching origin regencies:', error));

      fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selectedDestinationProvinceId}.json`)
       .then(response => response.json())
       .then(destinationRegencies => {
          const destinationAdditionalSelect = document.getElementById('destination-additional');

          destinationRegencies.forEach(regency => {
            const option = document.createElement('option');
            option.value = regency.id;
            option.textContent = regency.name;
            destinationAdditionalSelect.appendChild(option);
          });
        })
       .catch(error => console.error('Error fetching destination regencies:', error));
    });
  })
 .catch(error => console.error('Error fetching provinces:', error));