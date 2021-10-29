const shop = document.querySelector('.shop');
const panier = document.querySelector('.panier');
const cat = document.querySelector('.categories');
const tbody = document.querySelector('.tbody');
const total = document.getElementById('total');






const add = (ar_p,all_pros,html_el) =>{
    all_pros.map(el => el.qty = 1);
    let cart = [];
    let cart_html = "";
    let result = [];
    let tot = 0;
    ar_p.forEach(element => {
        element.addEventListener('click',(e)=>{
           let attribut  = e.target.parentNode.getAttribute("id");

           result =  all_pros.filter(el => el.pro_id === attribut);

           !cart.includes(...result) ? cart = [...cart,...result]: result[0].qty += 1 

           tot = cart.reduce((a,b) => a + b.pro_prix * b.qty, 0); 
          
           total.textContent = tot + " €";
          
           cart_html = cart.map(pro => {   
                const {pro_id:id,pro_libelle:libelle,pro_photo:photo,pro_prix:price,qty} = pro    
                     
            return `<tr>
                <td><img width="60" src="./jarditou_photos/${id}.${photo}"></td>
                <td><h4>${libelle}</h4></td>
                <td><h4>${price} € </h4></td>
                <td><h4>${qty}</h4></td>
                <td><button id="${id}" class="pro_plus" type="button">+</button></td>
                <td><button id="${id}" class="pro_remove" type="button">-</button></td>
            </tr>`
            }).join('')
            html_el.innerHTML = cart_html;    
           
        })
        
    });
    
      
}




const getProducts = async () => {
    
    const res = await fetch("http://localhost:82/jarditou_server/pros.php")
    if(res.ok){
        const pros = await res.json()
        pros.map(el => el.qty = 1);
        const html =  pros.map(pro => {
            const {pro_id:id,pro_libelle:libelle,pro_description:desc,pro_photo:photo,pro_prix:price} = pro 
            return `<div id="${id}"  class="product">
            <img src="./jarditou_photos/${id}.${photo}">
            <h4>${libelle}</h4>
            <h4>${price} € </h4>
            <button id="${id}" class="pro_add" type="button">Ajouter</button>
            <h4>description :</h4>
            <p>${desc}</p>
            </div>`
        }).join('')
        shop.innerHTML = html;
        const btns_add = document.querySelectorAll('.pro_add');
        add(btns_add,pros,tbody)


  

  
    }else{
        console.error('error : ', res.status);
    }
    
}

const getCategories = async () =>{
    const res = await fetch('http://localhost:82/jarditou_server/cats.php')
    if(res.ok){
        const cats = await res.json();
        const html_cat = cats.map(cat => {
            const {cat_id, cat_nom} = cat
            return `<li id="${cat_id}"><h4>${cat_nom}</h4></li>`
    }).join('');
    cat.innerHTML = html_cat;
    const cat_list = document.querySelectorAll('li')
}else{
    console.error('error : ', res.status);
}
}
getProducts();
getCategories();

