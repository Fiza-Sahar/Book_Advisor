<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit Story - Book Advisor</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/font-awesome.min.css">
<style>
:root{--cream:#f5f0e8;--warm-white:#faf7f2;--brown-dark:#3d1f0d;--brown-mid:#7a3f1e;--brown-accent:#9b5a2d;--gold:#b8966e;--text-dark:#2a1810;--text-mid:#5c3d2e;--shadow:rgba(61,31,13,0.15);}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--cream);font-family:'Cormorant Garamond',serif;color:var(--text-dark);}
nav{background:var(--warm-white);padding:18px 60px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(180,140,100,0.2);position:sticky;top:0;z-index:100;box-shadow:0 2px 20px var(--shadow);}
.logo{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-dark);letter-spacing:2px;text-decoration:none;}
.nav-links{display:flex;gap:36px;list-style:none;}
.nav-links a{text-decoration:none;color:var(--text-mid);font-size:0.85rem;letter-spacing:2px;text-transform:uppercase;transition:color 0.3s;}
.nav-links a:hover{color:var(--brown-accent);}

.page-hero{background:linear-gradient(160deg,#0a1a2a,#1e4a6b,#2a7a9b);padding:60px;position:relative;overflow:hidden;}
.page-hero::before{content:'📖';position:absolute;right:80px;top:50%;transform:translateY(-50%);font-size:8rem;opacity:0.1;}
.hero-badge{display:inline-block;padding:5px 16px;border:1px solid rgba(255,255,255,0.25);border-radius:30px;color:rgba(255,255,255,0.7);font-size:0.78rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:15px;position:relative;}
.page-hero h1{font-family:'Playfair Display',serif;color:#fff;font-size:2.6rem;position:relative;}
.page-hero p{color:rgba(255,255,255,0.65);margin-top:8px;position:relative;}

.layout{max-width:1100px;margin:50px auto;padding:0 30px;display:grid;grid-template-columns:1fr 320px;gap:30px;align-items:start;}
.card{background:var(--warm-white);border:1px solid rgba(180,140,100,0.15);border-radius:4px;box-shadow:0 4px 25px var(--shadow);overflow:hidden;animation:fadeUp 0.5s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(25px);}to{opacity:1;transform:translateY(0);}}
.card-header{padding:22px 28px;border-bottom:1px solid rgba(180,140,100,0.12);}
.card-header h2{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-dark);}
.card-body{padding:28px;}

.form-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:22px;}
.form-group{display:flex;flex-direction:column;gap:8px;margin-bottom:22px;}
.form-group.no-mb{margin-bottom:0;}
.form-group label{font-size:0.75rem;letter-spacing:2px;text-transform:uppercase;color:var(--text-mid);display:flex;justify-content:space-between;}
.form-group label span{color:var(--gold);}
.form-group input,.form-group select,.form-group textarea{padding:12px 16px;border:1px solid rgba(180,140,100,0.3);border-radius:3px;background:var(--cream);font-family:'Cormorant Garamond',serif;font-size:1rem;color:var(--text-dark);outline:none;transition:all 0.3s;}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--brown-accent);background:var(--warm-white);box-shadow:0 0 0 3px rgba(155,90,45,0.1);}

/* GENRE CHIPS */
.genre-select-grid{display:flex;flex-wrap:wrap;gap:8px;margin-top:5px;}
.genre-chip{padding:7px 18px;border:1px solid rgba(180,140,100,0.35);border-radius:30px;font-size:0.85rem;cursor:pointer;color:var(--text-mid);background:transparent;font-family:'Cormorant Garamond',serif;transition:all 0.3s;}
.genre-chip:hover,.genre-chip.sel{background:var(--brown-accent);color:#fff;border-color:var(--brown-accent);}

.editor-wrap{border:1px solid rgba(180,140,100,0.3);border-radius:3px;overflow:hidden;transition:all 0.3s;}
.editor-wrap:focus-within{border-color:var(--brown-accent);box-shadow:0 0 0 3px rgba(155,90,45,0.1);}
.editor-toolbar{display:flex;gap:4px;padding:10px 12px;background:var(--cream);border-bottom:1px solid rgba(180,140,100,0.2);flex-wrap:wrap;}
.toolbar-btn{width:32px;height:32px;border:none;border-radius:3px;background:transparent;cursor:pointer;color:var(--text-mid);font-size:0.85rem;transition:all 0.2s;display:flex;align-items:center;justify-content:center;}
.toolbar-btn:hover{background:rgba(155,90,45,0.1);color:var(--brown-accent);}
.toolbar-sep{width:1px;background:rgba(180,140,100,0.25);margin:4px 4px;align-self:stretch;}
.editor-area{width:100%;min-height:400px;padding:25px;border:none;outline:none;resize:none;font-family:'Cormorant Garamond',serif;font-size:1.1rem;line-height:2;color:var(--text-dark);background:var(--warm-white);}
.word-count-bar{display:flex;justify-content:space-between;align-items:center;padding:10px 16px;background:var(--cream);border-top:1px solid rgba(180,140,100,0.15);font-size:0.82rem;color:var(--text-mid);}
.wc-progress{width:120px;height:4px;background:rgba(180,140,100,0.2);border-radius:2px;overflow:hidden;}
.wc-fill{height:100%;background:var(--brown-accent);border-radius:2px;transition:width 0.3s;}

/* CHAPTERS */
.chapters-section{background:rgba(155,90,45,0.04);border:1px solid rgba(180,140,100,0.15);border-radius:4px;padding:20px;margin-bottom:22px;}
.chapters-title{font-family:'Playfair Display',serif;font-size:1rem;color:var(--brown-dark);margin-bottom:15px;}
.chapter-item{display:flex;gap:10px;margin-bottom:10px;align-items:center;}
.chapter-inp{flex:1;padding:9px 14px;border:1px solid rgba(180,140,100,0.25);border-radius:3px;background:var(--cream);font-family:'Cormorant Garamond',serif;font-size:0.95rem;outline:none;}
.chapter-inp:focus{border-color:var(--brown-accent);}
.ch-del{width:32px;height:32px;border:none;border-radius:50%;background:rgba(244,67,54,0.1);color:#c62828;cursor:pointer;transition:all 0.2s;display:flex;align-items:center;justify-content:center;}
.ch-del:hover{background:rgba(244,67,54,0.2);}
.btn-add-ch{background:transparent;border:1px dashed rgba(180,140,100,0.4);color:var(--brown-accent);padding:8px 18px;border-radius:3px;cursor:pointer;font-family:'Cormorant Garamond',serif;font-size:0.85rem;letter-spacing:1px;transition:all 0.3s;display:flex;align-items:center;gap:6px;}
.btn-add-ch:hover{border-style:solid;background:rgba(155,90,45,0.06);}

.btn{padding:13px 28px;border:none;cursor:pointer;font-family:'Cormorant Garamond',serif;font-size:0.88rem;letter-spacing:2px;text-transform:uppercase;border-radius:3px;transition:all 0.3s;display:inline-flex;align-items:center;gap:8px;}
.btn-primary{background:var(--brown-accent);color:#fff;box-shadow:0 4px 15px rgba(155,90,45,0.3);}
.btn-primary:hover{background:var(--brown-mid);transform:translateY(-2px);}
.btn-outline{background:transparent;color:var(--brown-accent);border:1px solid var(--brown-accent);}
.btn-outline:hover{background:var(--brown-accent);color:#fff;}
.submit-section{margin-top:25px;display:flex;gap:12px;flex-wrap:wrap;align-items:center;}

/* SIDEBAR */
.guidelines-card{animation-delay:0.1s;position:sticky;top:80px;}
.comp-info-card{background:linear-gradient(135deg,#0a1a2a,#1e4a6b);border-radius:4px;padding:22px;color:#fff;text-align:center;margin-bottom:20px;}
.comp-info-card h3{font-family:'Playfair Display',serif;font-size:1.2rem;color:var(--gold);margin-bottom:8px;}
.comp-info-card p{font-size:0.88rem;opacity:0.7;line-height:1.6;margin-bottom:15px;}
.prize-chips{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;}
.prize-chip{background:rgba(255,255,255,0.08);border-radius:4px;padding:10px 5px;text-align:center;}
.prize-chip-amt{font-family:'Playfair Display',serif;font-size:1rem;color:var(--gold);}
.prize-chip-lbl{font-size:0.68rem;opacity:0.6;text-transform:uppercase;letter-spacing:1px;}

.cd-box{background:rgba(155,90,45,0.06);border:1px solid rgba(155,90,45,0.15);border-radius:4px;padding:16px;text-align:center;margin-bottom:20px;}
.cd-title{font-size:0.75rem;letter-spacing:2px;text-transform:uppercase;color:var(--text-mid);margin-bottom:10px;}
.cd-row{display:flex;justify-content:center;gap:8px;}
.cd-item{text-align:center;min-width:48px;}
.cd-num{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-accent);}
.cd-lbl{font-size:0.62rem;letter-spacing:1px;text-transform:uppercase;color:var(--text-mid);}

.guideline-item{display:flex;gap:12px;padding:12px 0;border-bottom:1px solid rgba(180,140,100,0.1);}
.guideline-item:last-child{border-bottom:none;}
.guideline-icon{width:34px;height:34px;border-radius:50%;background:rgba(155,90,45,0.1);display:flex;align-items:center;justify-content:center;color:var(--brown-accent);flex-shrink:0;}
.guideline-title{font-family:'Playfair Display',serif;font-size:0.92rem;color:var(--brown-dark);margin-bottom:2px;}
.guideline-desc{font-size:0.8rem;color:var(--text-mid);line-height:1.5;}

.success-overlay{position:fixed;inset:0;background:rgba(61,31,13,0.75);display:none;align-items:center;justify-content:center;z-index:999;backdrop-filter:blur(6px);}
.success-box{background:var(--warm-white);padding:55px;border-radius:8px;text-align:center;max-width:460px;width:90%;animation:popIn 0.5s cubic-bezier(0.34,1.56,0.64,1);}
@keyframes popIn{from{opacity:0;transform:scale(0.8);}to{opacity:1;transform:scale(1);}}
.success-icon{width:80px;height:80px;border-radius:50%;background:rgba(155,90,45,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:2rem;color:var(--brown-accent);}
.success-box h2{font-family:'Playfair Display',serif;font-size:2rem;color:var(--brown-dark);margin-bottom:10px;}
.success-box p{color:var(--text-mid);line-height:1.7;margin-bottom:25px;}
.btn-back{display:inline-block;padding:12px 30px;background:var(--brown-accent);color:#fff;text-decoration:none;border-radius:3px;font-family:'Cormorant Garamond',serif;font-size:0.85rem;letter-spacing:2px;text-transform:uppercase;transition:all 0.3s;}
.btn-back:hover{background:var(--brown-mid);}

footer{background:var(--brown-dark);color:rgba(255,255,255,0.6);padding:40px 60px 22px;margin-top:60px;}
.footer-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:40px;margin-bottom:30px;}
.footer-brand h3{font-family:'Playfair Display',serif;color:var(--gold);letter-spacing:2px;margin-bottom:10px;}
.footer-col h4{color:var(--gold);letter-spacing:2px;font-size:0.8rem;text-transform:uppercase;margin-bottom:12px;}
.footer-col a{display:block;color:rgba(255,255,255,0.6);text-decoration:none;margin-bottom:8px;font-size:0.9rem;transition:color 0.3s;}
.footer-col a:hover{color:var(--gold);}
.footer-bottom{border-top:1px solid rgba(255,255,255,0.1);padding-top:16px;text-align:center;font-size:0.82rem;}
</style>
</head>
<body>

    <!-- NAVIGATION -->
<?php
include("./shared1/nav.php");
?>

<div class="page-hero">
  <div class="hero-badge"><i class="fa fa-book" style="color:var(--gold);margin-right:6px;"></i> Short Story Challenge 2025</div>
  <h1>Submit Your Story</h1>
  <p>Winter Worlds — "A World Where Books Have Magical Powers"</p>
</div>

<div class="layout">
  <!-- FORM -->
  <div>
    <div class="card">
      <div class="card-header"><h2>Your Story Submission</h2></div>
      <div class="card-body">
        <div class="form-group">
          <label>Story Title <span>Required</span></label>
          <input type="text" id="storyTitle" placeholder="Give your story an unforgettable name..." maxlength="120">
        </div>

        <div class="form-row">
          <div class="form-group no-mb">
            <label>Author Name</label>
            <input type="text" value="Ahmad Khan" readonly style="background:rgba(155,90,45,0.05);">
          </div>
          <div class="form-group no-mb">
            <label>Target Audience</label>
            <select>
              <option>Young Adult (13-18)</option>
              <option>Adult (18+)</option>
              <option>All Ages</option>
            </select>
          </div>
        </div>

        <div class="form-group" style="margin-top:22px;">
          <label>Genre Tags</label>
          <div class="genre-select-grid">
            <button type="button" class="genre-chip sel" onclick="this.classList.toggle('sel')">Fantasy</button>
            <button type="button" class="genre-chip" onclick="this.classList.toggle('sel')">Sci-Fi</button>
            <button type="button" class="genre-chip" onclick="this.classList.toggle('sel')">Adventure</button>
            <button type="button" class="genre-chip" onclick="this.classList.toggle('sel')">Mystery</button>
            <button type="button" class="genre-chip" onclick="this.classList.toggle('sel')">Romance</button>
            <button type="button" class="genre-chip" onclick="this.classList.toggle('sel')">Horror</button>
            <button type="button" class="genre-chip" onclick="this.classList.toggle('sel')">Literary</button>
          </div>
        </div>

        <div class="form-group">
          <label>Story Synopsis <span>Max 200 words</span></label>
          <textarea rows="3" placeholder="A brief compelling summary of your story (shown to judges first)..."></textarea>
        </div>

        <!-- CHAPTERS -->
        <div class="chapters-section">
          <div class="chapters-title">Chapter Structure <span style="font-weight:300;font-size:0.85rem;color:var(--text-mid);">(optional)</span></div>
          <div id="chapterList">
            <div class="chapter-item">
              <input class="chapter-inp" type="text" placeholder="Chapter 1: The Ancient Library">
              <button type="button" class="ch-del" onclick="removeChapter(this)"><i class="fa fa-times" style="font-size:0.8rem;"></i></button>
            </div>
          </div>
          <button type="button" class="btn-add-ch" onclick="addChapter()"><i class="fa fa-plus"></i> Add Chapter</button>
        </div>

        <div class="form-group">
          <label>Your Story <span id="wc-label2">0 / 3000 words</span></label>
          <div class="editor-wrap">
            <div class="editor-toolbar">
              <button type="button" class="toolbar-btn" onclick="fmt('bold')"><i class="fa fa-bold"></i></button>
              <button type="button" class="toolbar-btn" onclick="fmt('italic')"><i class="fa fa-italic"></i></button>
              <button type="button" class="toolbar-btn" onclick="fmt('underline')"><i class="fa fa-underline"></i></button>
              <div class="toolbar-sep"></div>
              <button type="button" class="toolbar-btn" onclick="fmt('justifyLeft')"><i class="fa fa-align-left"></i></button>
              <button type="button" class="toolbar-btn" onclick="fmt('justifyCenter')"><i class="fa fa-align-center"></i></button>
              <div class="toolbar-sep"></div>
              <button type="button" class="toolbar-btn" onclick="fmt('undo')"><i class="fa fa-undo"></i></button>
              <button type="button" class="toolbar-btn" onclick="fmt('redo')"><i class="fa fa-repeat"></i></button>
            </div>
            <div class="editor-area" contenteditable="true" id="storyEditor" oninput="updateWC2()"></div>
            <div class="word-count-bar">
              <span id="wc2-text">0 words</span>
              <div class="wc-progress"><div class="wc-fill" id="wcFill2" style="width:0%"></div></div>
              <span>Max: 3000 words</span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label style="align-items:center;gap:8px;cursor:pointer;flex-direction:row;">
            <input type="checkbox" style="accent-color:var(--brown-accent);">
            I confirm this is my original, unpublished story
          </label>
        </div>

        <div class="submit-section">
          <button type="button" class="btn btn-primary" onclick="submitStory()"><i class="fa fa-paper-plane"></i> Submit Story</button>
          <button type="button" class="btn btn-outline"><i class="fa fa-save"></i> Save Draft</button>
        </div>
      </div>
    </div>
  </div>

  <!-- SIDEBAR -->
  <div>
    <div class="comp-info-card" style="animation:fadeUp 0.5s ease both;">
      <h3>Winter Worlds Challenge</h3>
      <p>Write a short story set in a world where books hold magical powers. Let your imagination guide you.</p>
      <div class="prize-chips">
        <div class="prize-chip"><div class="prize-chip-amt">$300</div><div class="prize-chip-lbl">1st</div></div>
        <div class="prize-chip"><div class="prize-chip-amt">$150</div><div class="prize-chip-lbl">2nd</div></div>
        <div class="prize-chip"><div class="prize-chip-amt">$75</div><div class="prize-chip-lbl">3rd</div></div>
      </div>
    </div>

    <div class="cd-box" style="animation:fadeUp 0.5s 0.1s ease both;">
      <div class="cd-title">Time to Deadline</div>
      <div class="cd-row" id="story-cd"></div>
    </div>

    <div class="card guidelines-card" style="animation-delay:0.15s;">
      <div class="card-header"><h2>Story Rules</h2></div>
      <div class="card-body">
        <div class="guideline-item">
          <div class="guideline-icon"><i class="fa fa-file-text-o"></i></div>
          <div><div class="guideline-title">Word Limit</div><div class="guideline-desc">800 – 3000 words including dialogue and description.</div></div>
        </div>
        <div class="guideline-item">
          <div class="guideline-icon"><i class="fa fa-magic"></i></div>
          <div><div class="guideline-title">Theme</div><div class="guideline-desc">Books must feature prominently as magical objects.</div></div>
        </div>
        <div class="guideline-item">
          <div class="guideline-icon"><i class="fa fa-star"></i></div>
          <div><div class="guideline-title">Originality</div><div class="guideline-desc">No AI-generated content. Must be human-written.</div></div>
        </div>
        <div class="guideline-item">
          <div class="guideline-icon"><i class="fa fa-heart"></i></div>
          <div><div class="guideline-title">Content</div><div class="guideline-desc">Keep it appropriate for all audiences.</div></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="success-overlay" id="successOverlay">
  <div class="success-box">
    <div class="success-icon"><i class="fa fa-book"></i></div>
    <h2>Story Submitted!</h2>
    <p>Your story has been received! Our judges will carefully read every submission. Winners announced May 1, 2025.</p>
    <div style="font-family:'Playfair Display',serif;color:var(--text-mid);margin-bottom:20px;">ID: <span style="color:var(--brown-accent);">STR-2025-0047</span></div>
    <a href="competitions.php" class="btn-back"><i class="fa fa-trophy"></i> View Competitions</a>
  </div>
</div>

<footer>
  <div class="footer-grid">
    <div class="footer-brand"><h3>BOOK ADVISOR</h3><p>Curating the finest stories for the modern reader.</p></div>
    <div class="footer-col"><h4>Quick Links</h4><a href="index.php">Home</a><a href="browse_books.php">Shop</a><a href="competitions.php">Competitions</a></div>
    <div class="footer-col"><h4>Connect</h4><p>support@bookadvisor.com</p></div>
  </div>
  <div class="footer-bottom">© 2025 Book Advisor. All Rights Reserved.</div>
</footer>

<script>
function fmt(cmd){document.execCommand(cmd,false,null);}
function updateWC2(){
  const text=document.getElementById('storyEditor').innerText;
  const words=text.trim()?text.trim().split(/\s+/).length:0;
  document.getElementById('wc2-text').textContent=words+' words';
  document.getElementById('wc-label2').textContent=words+' / 3000 words';
  const pct=Math.min(words/3000*100,100);
  document.getElementById('wcFill2').style.width=pct+'%';
  document.getElementById('wcFill2').style.background=pct>90?'#c0392b':'var(--brown-accent)';
}
let chapCount=1;
function addChapter(){
  chapCount++;
  const div=document.createElement('div');div.className='chapter-item';
  div.innerHTML=`<input class="chapter-inp" type="text" placeholder="Chapter ${chapCount}: "><button type="button" class="ch-del" onclick="removeChapter(this)"><i class="fa fa-times" style="font-size:0.8rem;"></i></button>`;
  document.getElementById('chapterList').appendChild(div);
}
function removeChapter(btn){if(document.querySelectorAll('.chapter-item').length>1)btn.closest('.chapter-item').remove();}
function submitStory(){
  const title=document.getElementById('storyTitle').value;
  if(!title){alert('Please enter a story title.');return;}
  document.getElementById('successOverlay').style.display='flex';
}
document.getElementById('successOverlay').addEventListener('click',function(e){if(e.target===this)this.style.display='none';});

function buildCD(id,deadline){
  const el=document.getElementById(id);
  function upd(){
    const diff=new Date(deadline)-new Date();
    if(diff<=0){el.innerHTML='Expired';return;}
    const d=Math.floor(diff/86400000),h=Math.floor((diff%86400000)/3600000),m=Math.floor((diff%3600000)/60000);
    el.innerHTML=`<div class="cd-item"><div class="cd-num">${d}</div><div class="cd-lbl">Days</div></div><div class="cd-item"><div class="cd-num">${h}</div><div class="cd-lbl">Hrs</div></div><div class="cd-item"><div class="cd-num">${m}</div><div class="cd-lbl">Min</div></div>`;
  }
  upd();setInterval(upd,60000);
}
buildCD('story-cd','2025-04-15');
</script>
</body>
</html>
