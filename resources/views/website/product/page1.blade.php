@extends('website.master')

@section('title')


@endsection

@section('body')


<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@300;400&display=swap');
*{box-sizing:border-box;margin:0;padding:0}
:root{
  --gold:#c8a45a;--gold-light:#e4ceA0;--gold-subtle:rgba(200,164,90,0.10);--gold-dark:#8f6f30;
  --ink:#0e0d0b;--ink-soft:#1c1a17;--off-white:#faf9f7;--cream:#f4f1ea;
  --light-gray:#e9e5dc;--mid-gray:#aca89f;--dark-gray:#6a665e;--charcoal:#242220;
  --accent:#c94f2a;--accent-soft:#fce9e3;--white:#fff;
  --font-display:'Cormorant Garamond',Georgia,serif;
  --font-body:'DM Sans',system-ui,sans-serif;
  --font-mono:'DM Mono',monospace;
  --radius-sm:3px;--radius-md:8px;--radius-lg:14px;
  --tr:0.25s cubic-bezier(0.4,0,0.2,1);
}
body{background:var(--off-white);font-family:var(--font-body);color:var(--ink);}
.page-wrap{max-width:1280px;margin:0 auto;padding:48px 24px 80px;}

.section-label{display:inline-block;font-size:10px;font-weight:600;letter-spacing:0.22em;text-transform:uppercase;color:var(--gold-dark);background:var(--gold-subtle);padding:5px 14px;border-radius:var(--radius-sm);margin-bottom:14px;}
.section-heading{font-family:var(--font-display);font-size:42px;font-weight:300;letter-spacing:0.04em;line-height:1.1;color:var(--ink);margin-bottom:10px;}
.section-heading em{color:var(--gold);font-style:italic;}
.section-desc{font-size:13.5px;color:var(--dark-gray);letter-spacing:0.02em;line-height:1.6;}

.trending-header{display:flex;align-items:flex-end;justify-content:space-between;gap:24px;margin-bottom:36px;padding-bottom:24px;border-bottom:1px solid var(--light-gray);}
.btn-explore-all{display:inline-flex;align-items:center;gap:10px;padding:12px 26px;border:1px solid var(--ink);color:var(--ink);font-family:var(--font-body);font-size:10.5px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;text-decoration:none;border-radius:var(--radius-md);transition:all var(--tr);white-space:nowrap;flex-shrink:0;}
.btn-explore-all:hover{background:var(--ink);color:var(--gold);}
.arrow-icon{display:flex;align-items:center;font-size:14px;}

.filter-bar{display:flex;align-items:center;gap:10px;margin-bottom:32px;flex-wrap:wrap;}
.filter-chip{padding:7px 18px;border:1px solid var(--light-gray);border-radius:30px;font-size:11px;font-weight:500;letter-spacing:0.08em;text-transform:uppercase;color:var(--dark-gray);background:var(--white);cursor:pointer;transition:all var(--tr);}
.filter-chip:hover,.filter-chip.active{background:var(--ink);color:var(--gold);border-color:var(--ink);}
.filter-right{margin-left:auto;display:flex;align-items:center;gap:8px;font-size:11.5px;color:var(--mid-gray);}
.sort-select{border:1px solid var(--light-gray);border-radius:var(--radius-md);padding:7px 14px;font-family:var(--font-body);font-size:11.5px;color:var(--dark-gray);background:var(--white);cursor:pointer;appearance:none;-webkit-appearance:none;padding-right:28px;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%23aca89f'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 10px center;}

.product-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:24px;margin-bottom:48px;}

.product-card{background:var(--white);border:1px solid var(--light-gray);border-radius:var(--radius-lg);overflow:hidden;position:relative;transition:border-color var(--tr),box-shadow var(--tr);display:flex;flex-direction:column;}
.product-card:hover{border-color:rgba(200,164,90,0.45);box-shadow:0 12px 40px rgba(14,13,11,0.10);}

.badge-new{position:absolute;top:14px;left:14px;z-index:2;background:var(--gold);color:var(--ink);font-family:var(--font-body);font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;padding:4px 10px;border-radius:var(--radius-sm);}
.badge-sale{position:absolute;top:14px;left:14px;z-index:2;background:var(--accent);color:var(--white);font-family:var(--font-body);font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;padding:4px 10px;border-radius:var(--radius-sm);}
.badge-hot{position:absolute;top:14px;left:14px;z-index:2;background:var(--charcoal);color:var(--gold-light);font-family:var(--font-body);font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;padding:4px 10px;border-radius:var(--radius-sm);}

.img-wrap{position:relative;overflow:hidden;background:var(--cream);aspect-ratio:1/1;}
.img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform 0.4s ease;}
.product-card:hover .img-wrap img{transform:scale(1.05);}
.img-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--light-gray);font-size:48px;}

.overlay-btn{position:absolute;inset:0;display:flex;align-items:flex-end;justify-content:center;gap:8px;padding:16px;opacity:0;transition:opacity var(--tr);}
.product-card:hover .overlay-btn{opacity:1;}
.btn-cart,.btn-details{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;font-family:var(--font-body);font-size:10.5px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;text-decoration:none;border-radius:var(--radius-md);cursor:pointer;border:none;transition:all var(--tr);}
.btn-cart{background:var(--ink);color:var(--gold-light);}
.btn-cart:hover{background:var(--gold);color:var(--ink);}
.btn-details{background:rgba(255,255,255,0.9);color:var(--charcoal);}
.btn-details:hover{background:var(--white);color:var(--ink);}

.product-body{padding:16px 16px 10px;}
.cat-tag{font-size:9.5px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:var(--gold);margin-bottom:6px;}
.product-body h4{font-family:var(--font-body);font-size:13.5px;font-weight:500;color:var(--ink);line-height:1.35;margin-bottom:8px;}
.product-body h4 a{color:inherit;text-decoration:none;}
.product-body h4 a:hover{color:var(--gold-dark);}
.stars{display:flex;align-items:center;gap:2px;font-size:11px;color:var(--gold);}
.stars .star-empty{color:var(--light-gray);}
.stars span{font-family:var(--font-mono);font-size:10.5px;color:var(--mid-gray);margin-left:4px;}

.price-row{display:flex;align-items:center;justify-content:space-between;padding:10px 16px 14px;margin-top:auto;}
.price{font-family:var(--font-mono);font-size:15px;font-weight:400;color:var(--ink);letter-spacing:0.02em;}
.price-old{font-size:11.5px;color:var(--mid-gray);text-decoration:line-through;margin-left:6px;}
.wishlist-btn{width:34px;height:34px;border:1px solid var(--light-gray);border-radius:50%;display:flex;align-items:center;justify-content:center;background:var(--white);color:var(--mid-gray);font-size:15px;cursor:pointer;transition:all var(--tr);}
.wishlist-btn:hover{border-color:var(--accent);color:var(--accent);background:var(--accent-soft);}

.trending-footer{text-align:center;padding-top:12px;border-top:1px solid var(--light-gray);}
.btn-explore-bottom{display:inline-flex;align-items:center;gap:10px;padding:14px 36px;background:var(--ink);color:var(--gold-light);font-family:var(--font-body);font-size:10.5px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;text-decoration:none;border-radius:var(--radius-md);transition:all var(--tr);}
.btn-explore-bottom:hover{background:var(--gold);color:var(--ink);}
.result-count{font-size:12px;color:var(--mid-gray);margin-bottom:20px;letter-spacing:0.04em;}
</style>

<div class="page-wrap">

  <div class="trending-header">
    <div class="trending-header-left">
      <div class="section-label">Hot Right Now</div>
      <h2 class="section-heading">Trending <em>Products</em></h2>
      <p class="section-desc">The most-loved products this week, flying off our shelves.</p>
    </div>
    <a href="#" class="btn-explore-all">
      <span>Explore All</span>
      <span class="arrow-icon">→</span>
    </a>
  </div>

  <div class="filter-bar">
    <button class="filter-chip active">All</button>
    <button class="filter-chip">Electronics</button>
    <button class="filter-chip">Fashion</button>
    <button class="filter-chip">Home & Living</button>
    <button class="filter-chip">Beauty</button>
    <button class="filter-chip">Sports</button>
    <div class="filter-right">
      Sort by:
      <select class="sort-select">
        <option>Trending</option>
        <option>Price: Low to High</option>
        <option>Price: High to Low</option>
        <option>Newest</option>
      </select>
    </div>
  </div>

  <p class="result-count">Showing 30 of 128 products</p>

  <div class="product-grid" id="productGrid"></div>

  <div class="trending-footer">
    <a href="#" class="btn-explore-bottom">
      ⊞ &nbsp;Explore All Products
    </a>
  </div>

</div>

<script>
const products = [ 
  
  {name:"Slim Leather Wallet",cat:"Fashion",price:"৳1,290.00",old:null,rating:4,reviews:64,badge:"new",color:"#c8b89a"},
  {name:"Ceramic Desk Lamp",cat:"Home & Living",price:"৳2,750.00",old:"৳3,100.00",rating:4,reviews:41,badge:"sale",color:"#e8e0d4"},
  {name:"Matte Lip Collection",cat:"Beauty",price:"৳890.00",old:null,rating:5,reviews:203,badge:"hot",color:"#e8cdc8"},
  {name:"Running Sneakers X9",cat:"Sports",price:"৳5,499.00",old:"৳7,000.00",rating:4,reviews:87,badge:"sale",color:"#c5cfd8"},
  {name:"Bamboo Phone Stand",cat:"Electronics",price:"৳650.00",old:null,rating:4,reviews:32,badge:null,color:"#d4c8a8"},
  {name:"Linen Throw Blanket",cat:"Home & Living",price:"৳1,850.00",old:null,rating:5,reviews:56,badge:null,color:"#ddd5c4"},
  {name:"Vitamin C Serum",cat:"Beauty",price:"৳1,200.00",old:"৳1,500.00",rating:4,reviews:149,badge:"sale",color:"#f0e4c8"},
  {name:"Canvas Backpack 28L",cat:"Fashion",price:"৳3,100.00",old:null,rating:4,reviews:78,badge:null,color:"#c4b89a"},
  {name:"Smart Fitness Band",cat:"Electronics",price:"৳6,299.00",old:"৳8,500.00",rating:5,reviews:211,badge:"hot",color:"#c8d0d8"},
  {name:"Handmade Soy Candle",cat:"Home & Living",price:"৳750.00",old:null,rating:5,reviews:94,badge:"new",color:"#ede0c8"},
  {name:"Yoga Mat Pro",cat:"Sports",price:"৳2,200.00",old:"৳2,800.00",rating:4,reviews:66,badge:"sale",color:"#c8ddd0"},
  {name:"Stainless Travel Mug",cat:"Home & Living",price:"৳1,100.00",old:null,rating:4,reviews:45,badge:null,color:"#d0d4d8"},
  {name:"Ankle Boots — Camel",cat:"Fashion",price:"৳4,599.00",old:null,rating:5,reviews:38,badge:"new",color:"#d4b890"},
  {name:"Retinol Night Cream",cat:"Beauty",price:"৳1,650.00",old:"৳2,000.00",rating:4,reviews:172,badge:"sale",color:"#f0dcc8"},
  {name:"Mechanical Keyboard",cat:"Electronics",price:"৳8,900.00",old:null,rating:5,reviews:303,badge:"hot",color:"#c8ccd4"},
  {name:"Merino Wool Scarf",cat:"Fashion",price:"৳1,450.00",old:null,rating:4,reviews:29,badge:null,color:"#d8c8b4"},
  {name:"Adjustable Dumbbell Set",cat:"Sports",price:"৳9,500.00",old:"৳12,000.00",rating:5,reviews:88,badge:"sale",color:"#c4c8d0"},
  {name:"Rattan Wall Mirror",cat:"Home & Living",price:"৳3,400.00",old:null,rating:4,reviews:51,badge:null,color:"#d4c8a4"},
  {name:"SPF 50 Sunscreen",cat:"Beauty",price:"৳680.00",old:null,rating:4,reviews:241,badge:"hot",color:"#f4e8cc"},
  {name:"USB-C Hub 7-in-1",cat:"Electronics",price:"৳2,450.00",old:"৳3,000.00",rating:4,reviews:116,badge:"sale",color:"#c0c8d4"},
  {name:"Lace-Up Sneakers",cat:"Fashion",price:"৳3,250.00",old:null,rating:4,reviews:57,badge:null,color:"#dcdcd8"},
  {name:"Pour-Over Coffee Set",cat:"Home & Living",price:"৳2,100.00",old:null,rating:5,reviews:73,badge:"new",color:"#c8b8a0"},
  {name:"Foam Roller — Deep",cat:"Sports",price:"৳1,350.00",old:"৳1,800.00",rating:4,reviews:44,badge:"sale",color:"#c8d8e0"},
  {name:"Hyaluronic Face Mist",cat:"Beauty",price:"৳920.00",old:null,rating:5,reviews:188,badge:null,color:"#e4f0f4"},
  {name:"True Wireless Earbuds",cat:"Electronics",price:"৳3,800.00",old:"৳4,500.00",rating:5,reviews:267,badge:"hot",color:"#c4ccd8"},
  {name:"Oversized Linen Shirt",cat:"Fashion",price:"৳2,100.00",old:null,rating:4,reviews:36,badge:"new",color:"#dce4d4"},
  {name:"Protein Shaker Bottle",cat:"Sports",price:"৳550.00",old:null,rating:4,reviews:82,badge:null,color:"#d4e0dc"},
  {name:"Macramé Plant Hanger",cat:"Home & Living",price:"৳890.00",old:null,rating:5,reviews:61,badge:"new",color:"#ddd0b8"},
  {name:"Tinted Moisturiser",cat:"Beauty",price:"৳1,390.00",old:"৳1,700.00",rating:4,reviews:134,badge:"sale",color:"#f0e0d0"},
  {name:"Tinted Moisturiser",cat:"Beauty",price:"৳1,390.00",old:"৳1,700.00",rating:4,reviews:134,badge:"sale",color:"#f0e0d0"},
];

function stars(r){
  let s='';
  for(let i=1;i<=5;i++){
    s+=`<i class="${i<=r?'lni lni-star-filled':'lni lni-star star-empty'}"></i>`;
  }
  return s;
}

function badge(b){
  if(!b) return '';
  const cls = b==='new'?'badge-new':b==='sale'?'badge-sale':'badge-hot';
  return `<span class="${cls}">${b.toUpperCase()}</span>`;
}

const grid = document.getElementById('productGrid');
products.forEach((p,i)=>{
  grid.innerHTML += `
  <div class="product-card">
    ${badge(p.badge)}
    <div class="img-wrap">
      <div class="img-placeholder" style="background:${p.color};"></div>
      <div class="overlay-btn">
        <a class="btn-cart" href="#">
          <i class="lni lni-cart"></i> Cart
        </a>
        <a class="btn-details" href="#">
          <i class="lni lni-eye"></i> Details
        </a>
      </div>
    </div>
    <div class="product-body">
      <div class="cat-tag">${p.cat}</div>
      <h4><a href="#">${p.name}</a></h4>
      <div class="stars">
        ${stars(p.rating)}
        <span>${p.rating}.0 (${p.reviews})</span>
      </div>
    </div>
    <div class="price-row">
      <div>
        <span class="price">${p.price}</span>
        ${p.old?`<span class="price-old">${p.old}</span>`:''}
      </div>
      <button class="wishlist-btn" aria-label="Add to wishlist">
        <i class="lni lni-heart"></i>
      </button>
    </div>
  </div>`;
});

document.querySelectorAll('.filter-chip').forEach(chip=>{
  chip.addEventListener('click',function(){
    document.querySelectorAll('.filter-chip').forEach(c=>c.classList.remove('active'));
    this.classList.add('active');
  });
});
</script>


@endsection