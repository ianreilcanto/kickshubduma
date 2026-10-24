const products=[...document.querySelectorAll('.product-card')];
const grid=document.getElementById('productGrid');
const resultCount=document.getElementById('resultCount');
const emptyState=document.getElementById('emptyState');
const searchInput=document.getElementById('searchInput');
const priceRange=document.getElementById('priceRange');
const priceValue=document.getElementById('priceValue');
const sortSelect=document.getElementById('sortSelect');
const selectedSizes=new Set();
let activeCategory='all';
let bagCount=0;
let toastTimer;
function money(n){return '₱'+Number(n).toLocaleString('en-PH')}
function showToast(message){const toast=document.getElementById('toast');toast.textContent=message;toast.classList.add('show');clearTimeout(toastTimer);toastTimer=setTimeout(()=>toast.classList.remove('show'),2400)}
function renderProducts(){
  const query=searchInput.value.trim().toLowerCase();
  const activities=[...document.querySelectorAll('[data-filter="activity"]:checked')].map(x=>x.value);
  const maxPrice=Number(priceRange.value);
  let visible=products.filter(card=>{
    const categoryOk=activeCategory==='all'||card.dataset.category===activeCategory;
    const queryOk=!query||(card.dataset.name+' '+card.innerText).toLowerCase().includes(query);
    const activityOk=!activities.length||activities.includes(card.dataset.activity);
    const priceOk=Number(card.dataset.price)<=maxPrice;
    const sizes=card.dataset.sizes.split(',');
    const sizeOk=!selectedSizes.size||[...selectedSizes].some(s=>sizes.includes(s));
    const show=categoryOk&&queryOk&&activityOk&&priceOk&&sizeOk;
    card.hidden=!show;
    return show;
  });
  const sort=sortSelect.value;
  visible.sort((a,b)=>sort==='price-low'?Number(a.dataset.price)-Number(b.dataset.price):sort==='price-high'?Number(b.dataset.price)-Number(a.dataset.price):sort==='name'?a.dataset.name.localeCompare(b.dataset.name):Number(a.dataset.order)-Number(b.dataset.order));
  visible.forEach(card=>grid.appendChild(card));
  resultCount.textContent=visible.length;
  emptyState.hidden=visible.length>0;
}
document.querySelectorAll('.category').forEach(btn=>btn.addEventListener('click',()=>{
  activeCategory=btn.dataset.category;
  document.querySelectorAll('.category').forEach(x=>x.classList.toggle('active',x===btn));
  renderProducts();
}));
document.querySelectorAll('[data-filter="activity"]').forEach(el=>el.addEventListener('change',renderProducts));
document.querySelectorAll('[data-size]').forEach(btn=>btn.addEventListener('click',()=>{
  const size=btn.dataset.size;
  if(selectedSizes.has(size)){selectedSizes.delete(size);btn.classList.remove('selected')}
  else{selectedSizes.add(size);btn.classList.add('selected')}
  renderProducts();
}));
priceRange.addEventListener('input',()=>{priceValue.textContent=money(priceRange.value);renderProducts()});
searchInput.addEventListener('input',renderProducts);
sortSelect.addEventListener('change',renderProducts);
function clearFilters(){
  activeCategory='all';selectedSizes.clear();searchInput.value='';priceRange.value=priceRange.max;priceValue.textContent=money(priceRange.max);
  document.querySelectorAll('[data-filter="activity"]').forEach(x=>x.checked=false);
  document.querySelectorAll('[data-size]').forEach(x=>x.classList.remove('selected'));
  document.querySelectorAll('.category').forEach(x=>x.classList.toggle('active',x.dataset.category==='all'));
  sortSelect.value='featured';renderProducts();
}
document.getElementById('clearFilters').addEventListener('click',clearFilters);
document.getElementById('emptyReset').addEventListener('click',clearFilters);
document.querySelectorAll('.favorite').forEach(btn=>btn.addEventListener('click',()=>{
  btn.classList.toggle('saved');btn.textContent=btn.classList.contains('saved')?'♥':'♡';
  showToast(btn.classList.contains('saved')?'Added to your favourites':'Removed from your favourites');
}));
document.querySelectorAll('.quick-add').forEach(btn=>btn.addEventListener('click',()=>{
  const card=btn.closest('.product-card');
  bagCount++;document.getElementById('bagCount').textContent=bagCount;
  showToast(`${card.dataset.name} added to your bag`);
}));
document.getElementById('bagButton').addEventListener('click',()=>showToast(bagCount?`${bagCount} item${bagCount===1?'':'s'} in your bag`:'Your bag is empty'));
document.getElementById('searchToggle').addEventListener('click',()=>{searchInput.focus();document.getElementById('catalogue').scrollIntoView({behavior:'smooth'});});
document.getElementById('menuToggle').addEventListener('click',()=>{
  const nav=document.getElementById('mainNav');const open=nav.classList.toggle('open');
  document.getElementById('menuToggle').setAttribute('aria-expanded',String(open));
});
document.querySelectorAll('.filter-heading').forEach(btn=>btn.addEventListener('click',()=>{
  const group=btn.parentElement;const open=btn.getAttribute('aria-expanded')==='true';
  btn.setAttribute('aria-expanded',String(!open));btn.querySelector('span').textContent=open?'+':'−';
  [...group.children].slice(1).forEach(child=>child.hidden=open);
}));
document.getElementById('loadMore').addEventListener('click',()=>showToast('You’re viewing the current demo collection.'));
renderProducts();
