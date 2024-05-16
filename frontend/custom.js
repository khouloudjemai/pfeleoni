
const socket = io.connect('http://localhost:5000');

socket.on('update_post', function(data) {
    const datas = JSON.parse(data);
    var topbar = document.getElementById('topbar_posts');
    // topbar.classList.add('blink_me');
    var dash = document.getElementById('dashboard')

    // Clear the inner HTML of topbar
    topbar.innerHTML = '';

    datas.forEach(item => {
        const temp = document.getElementById(`temp_post_${item["post"]}`);
        temp.classList.add('temp');
        temp.innerHTML = item['temp'] + '<i class="bi bi-thermometer-half"></i> ' ;

        if (item['temp'] > item['temp_max']) {
            // Create alerttemp div
            const alerttemp = document.createElement('div');
            alerttemp.classList.add('alerttemp');
            alerttemp.classList.add('waring');
            alerttemp.classList.add('blink_me');

            temp.classList.add('blink_me');
            temp.classList.add('waring');
        

            alerttemp.innerHTML = `<div id="alerttemp-${item['post']}" class="alerttemp-post">post N° ${item['post']} has Excess temperature: <strong>${item['temp']}</strong></div>`;
            
            // Check if the alerttemp element already exists
            if (!document.getElementById(`alerttemp-${item['post']}`)) {
                topbar.appendChild(alerttemp);
                topbar.classList.remove('hideblock');
                dash.classList.add('alert')

            }
        } else {
            temp.classList.remove('blink_me');
            temp.classList.remove('waring');

        }
    });
        datas.forEach(item => {
            const hum = document.getElementById(`hum_post_${item["post"]}`);
            hum.classList.add('hum');
            hum.innerHTML = item['hum'] + '<i class="bi bi-droplet"></i> ' ;
    
            if (item['hum'] > item['hum_max']) {
                // Create alerthum div
                const alerthum = document.createElement('div');
                alerthum.classList.add('alerthum');
                hum.classList.add('blink_me');
                alerthum.classList.add('alerthum');
                hum.classList.add('waring');
                alerthum.classList.add('waring');
                alerthum.classList.add('blink_me');


    
                alerthum.innerHTML = `<div id="alerthum-${item['post']}" class="alerthum-post">post N° ${item['post']} has Excess humidité: <strong>${item['hum']}</strong></div>`;
                
                // Check if the alerthum element already exists
                if (!document.getElementById(`alerthum-${item['post']}`)) {
                    topbar.appendChild(alerthum);
                    topbar.classList.remove('hideblock');
                    dash.classList.add('alert')
    
                }
            } else {
                hum.classList.remove('blink_me');
                hum.classList.remove('waring');
    
            }
        });
    
        // Check if there are any elements with class 'alerthum-post' and if topbar does not have 'hideblock' class
        if (document.getElementsByClassName('alerttemp-post').length  === 0 && document.getElementsByClassName('alerthum-post').length === 0 && !topbar.classList.contains('hideblock')) {
            topbar.classList.add('hideblock');
            dash.classList.remove('alert')
    
        }
        // Get all elements with the class name "post_header"
        var posts = document.getElementsByClassName('post_header');
    
        // Convert HTMLCollection to an array-like object
        var postsArray = Array.from(posts);
    
        // Now you can use forEach to iterate over each element
        postsArray.forEach(function(element) {
            // console.log(element.getAttribute('data_post'));
        });
    });
    
    
    socket.on('update', function (data) {
        const dataList = JSON.parse(data);
        const dataListElement = document.getElementById('data-list');
        dataListElement.innerHTML = '';
        const sidebar = document.getElementById('sidebar');
        sidebar.innerHTML = ' <h2> Etat de Stock min </h2>';
    
        // Group items by position_x
        const groupedData = {};
        dataList.forEach(item => {
            const positionX = item.position_x;
            if (!groupedData[positionX]) {
                groupedData[positionX] = [];
            }
            groupedData[positionX].push(item);
        });
    
    
    
    
        // Ensure each position has a maximum of 32 items
        for (let i = 1; i <= 22; i++) {
            const positionXData = groupedData[i] || [];
            const gridContainer = document.createElement('div');
            gridContainer.classList.add('grid-container');
            const postNumber = document.createElement('div');
            postNumber.classList.add('post');
            postNumber.innerHTML = `<span id="temp_post_${i}"></span>
            <h2 class="post_header" data_post="${i}"> POST ${i}</h2> 
            <span id="hum_post_${i}"><i class="bi bi-moisture"></i></span>
            `
            gridContainer.appendChild(postNumber);
            console.log("positiondataX", positionXData.length)
            positionXData.forEach((item, index) => {
    
                const gridItem = document.createElement('div');
                gridItem.classList.add('grid-item');
                gridItem.innerHTML = `
            <span class="wire ${item["color"]}">${item["Leoni partnumber"]}</span>
            <span class="ref">${item["Customer part number"]}</span>`;
                const kaba = document.createElement('span');
                kaba.classList.add('kaba');
                kaba.textContent = item["Type of kaba"];
                gridItem.appendChild(kaba)
                if (item["qty per loop"] < item["min qty"]) {
                    const qty = document.createElement('span');
                    qty.classList.add('qty');
                    qty.classList.add('waring');
                    qty.classList.add('blink_me');
                    qty.textContent = item["qty per loop"];
                    gridItem.appendChild(qty);
                } else {
                    const qty = document.createElement('span');
                    qty.classList.add('qty');
                    qty.classList.add('safe');
                    qty.textContent = item["qty per loop"]; gridItem.appendChild(qty);
                };
    
                gridContainer.appendChild(gridItem);
    
    
                if ((index + 1) == positionXData.length) {
                    const gridItem = document.createElement('div');
                    gridItem.classList.add('grid-item');
                    gridItem.innerHTML = `
            <button class="addbutton" onclick="openModal(${item['position_x']},${item['position_y'] + 1})"> + </button> `
                    gridContainer.appendChild(gridItem);
    
                }
    
                if (item["qty per loop"] < item["min qty"]) {
    
                    const alert = document.createElement('div')
                    alert.classList.add('alert_bar');
                    alert.innerHTML = `
                    <span class="wire ${item["color"]}">${item["Leoni partnumber"]}</span>
                    <span class="qty"> LAD 1 : ${item["Position"]}</span>
                    <span class="qty blink_me waring">${item["qty per loop"]}</span>`
                    sidebar.appendChild(alert)
                }
    
    
    
            });
    
            if (positionXData.length == 0) {
                const gridItem = document.createElement('div');
                gridItem.classList.add('grid-item');
                gridItem.innerHTML = `
        <button class="addbutton" onclick="openModal(1,1)"> + </button> `
    
    
                gridContainer.appendChild(gridItem);
                // Add line break after every 3 items
            }
            // // Add empty items if needed to reach the maximum of 32 items per position
    
    
    
    
            // const addbutton = document.createElement('div');
            // addbutton.classList.add('grid-item');
            // addbutton.classList.add('add-button');
            // addbutton.innerHTML = `
            // `;
            // gridContainer.appendChild(addbutton);
    
            dataListElement.appendChild(gridContainer);
        }
    });
    
    
    
    function openModal(x = 0, y = 0) {
        if (x != 0) {
            document.getElementById('positionX').value = x
            document.getElementById('positionX').disabled = true;
            document.getElementById('positionY').value = y
            document.getElementById('positionY').disabled = true;
    
    
        }
        document.getElementById('myModal').style.display = "block";
    }
    
    function closeModal() {
        document.getElementById('myModal').style.display = "none";
    }
    
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
    document.addEventListener("DOMContentLoaded", function () {
    
        document.getElementById("insertForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the default form submission
    
            const formData = new FormData(this);
            // const data = {};
            // formData.forEach((value, key) => {
            //     data[key] = value;
            // });
    
            const data = {
                "Customer part number": document.getElementById('customerPartNumber').value,
                "ID wagon": document.getElementById('idWagon').value,
                "ID work station": document.getElementById('idWorkStation').value,
                "Leoni partnumber": document.getElementById('customerPartNumber').value,
                "Loop": document.getElementById('loop').value,
                "Position": document.getElementById('position').value,
                "Section": document.getElementById('section').value,
                "Supermarket location": document.getElementById('supermarketLocation').value,
                "Tabella/Variant": document.getElementById('tabellaVariant').value,
                "Type of kaba": document.getElementById('typeOfKaba').value,
                "UPDATE": document.getElementById('updateDate').value,
                "Weight (gr)": document.getElementById('weight').value,
                "Weight per Loop (gr)": document.getElementById('weightPerLoop').value,
                "barre code": document.getElementById('barreCode').value,
                "color": document.getElementById('color').value,
                "kurzname": document.getElementById('kurzname').value,
                "min qty": document.getElementById('minQty').value,
                "position_x": document.getElementById('positionX').value,
                "position_y": document.getElementById('positionY').value,
                "qty per loop": document.getElementById('qtyPerLoop').value
            }
                *
                fetch('http://localhost:5000/insert', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data inserted successfully:', data);
                        closeModal();
                        // Optionally, you can display a success message or redirect the user
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                        // Optionally, you can display an error message to the user
                    });
        });
    });
    

        