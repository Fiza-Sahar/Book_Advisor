<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit Essay - Book Advisor</title>
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

.page-hero{background:linear-gradient(160deg,var(--brown-dark),var(--brown-mid));padding:60px;position:relative;overflow:hidden;}
.page-hero::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M20 20.5V18H0v5h20v-2.5zM0 25h20v5H0z'/%3E%3C/g%3E%3C/svg%3E");}
.page-hero h1{font-family:'Playfair Display',serif;color:#fff;font-size:2.6rem;position:relative;}
.page-hero p{color:rgba(255,255,255,0.65);margin-top:8px;position:relative;}
.hero-badge{display:inline-block;padding:5px 16px;border:1px solid rgba(255,255,255,0.25);border-radius:30px;color:rgba(255,255,255,0.7);font-size:0.78rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:15px;position:relative;}

.layout{max-width:1100px;margin:50px auto;padding:0 30px;display:grid;grid-template-columns:1fr 320px;gap:30px;align-items:start;}

.card{background:var(--warm-white);border:1px solid rgba(180,140,100,0.15);border-radius:4px;box-shadow:0 4px 25px var(--shadow);overflow:hidden;animation:fadeUp 0.5s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(25px);}to{opacity:1;transform:translateY(0);}}
.card-header{padding:22px 28px;border-bottom:1px solid rgba(180,140,100,0.12);}
.card-header h2{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-dark);}
.card-body{padding:28px;}

.form-group{display:flex;flex-direction:column;gap:8px;margin-bottom:22px;}
.form-group label{font-size:0.75rem;letter-spacing:2px;text-transform:uppercase;color:var(--text-mid);display:flex;justify-content:space-between;}
.form-group label span{color:var(--gold);}
.form-group input,.form-group select,.form-group textarea{
  padding:12px 16px;border:1px solid rgba(180,140,100,0.3);border-radius:3px;
  background:var(--cream);font-family:'Cormorant Garamond',serif;font-size:1rem;
  color:var(--text-dark);outline:none;transition:all 0.3s;
}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--brown-accent);background:var(--warm-white);box-shadow:0 0 0 3px rgba(155,90,45,0.1);}

/* WRITING EDITOR */
.editor-wrap{border:1px solid rgba(180,140,100,0.3);border-radius:3px;overflow:hidden;transition:all 0.3s;}
.editor-wrap:focus-within{border-color:var(--brown-accent);box-shadow:0 0 0 3px rgba(155,90,45,0.1);}
.editor-toolbar{
  display:flex;gap:4px;padding:10px 12px;
  background:var(--cream);border-bottom:1px solid rgba(180,140,100,0.2);flex-wrap:wrap;
}
.toolbar-btn{
  width:32px;height:32px;border:none;border-radius:3px;background:transparent;
  cursor:pointer;color:var(--text-mid);font-size:0.85rem;transition:all 0.2s;
  display:flex;align-items:center;justify-content:center;
}
.toolbar-btn:hover{background:rgba(155,90,45,0.1);color:var(--brown-accent);}
.toolbar-sep{width:1px;background:rgba(180,140,100,0.25);margin:4px 4px;align-self:stretch;}
.editor-area{
  width:100%;min-height:350px;padding:20px;
  border:none;outline:none;resize:none;
  font-family:'Cormorant Garamond',serif;font-size:1.05rem;
  line-height:1.9;color:var(--text-dark);background:var(--warm-white);
}

/* WORD COUNT */
.word-count-bar{
  display:flex;justify-content:space-between;align-items:center;
  padding:10px 16px;background:var(--cream);border-top:1px solid rgba(180,140,100,0.15);
  font-size:0.82rem;color:var(--text-mid);
}
.wc-progress{width:120px;height:4px;background:rgba(180,140,100,0.2);border-radius:2px;overflow:hidden;}
.wc-fill{height:100%;background:var(--brown-accent);border-radius:2px;transition:width 0.3s;}

/* GUIDELINES SIDEBAR */
.guidelines-card{animation-delay:0.1s;position:sticky;top:80px;}
.guideline-item{display:flex;gap:12px;padding:14px 0;border-bottom:1px solid rgba(180,140,100,0.1);}
.guideline-item:last-child{border-bottom:none;}
.guideline-icon{width:36px;height:36px;border-radius:50%;background:rgba(155,90,45,0.1);display:flex;align-items:center;justify-content:center;color:var(--brown-accent);flex-shrink:0;}
.guideline-title{font-family:'Playfair Display',serif;font-size:0.95rem;color:var(--brown-dark);margin-bottom:3px;}
.guideline-desc{font-size:0.82rem;color:var(--text-mid);line-height:1.5;}

/* PRIZE DISPLAY */
.prize-display{background:linear-gradient(135deg,var(--brown-dark),var(--brown-mid));border-radius:4px;padding:22px;text-align:center;margin-bottom:20px;}
.prize-icon{font-size:2.5rem;margin-bottom:10px;}
.prize-amount{font-family:'Playfair Display',serif;color:var(--gold);font-size:2rem;}
.prize-label{color:rgba(255,255,255,0.6);font-size:0.82rem;letter-spacing:1px;text-transform:uppercase;margin-top:4px;}

/* DEADLINE COUNTDOWN */
.deadline-box{background:rgba(155,90,45,0.06);border:1px solid rgba(155,90,45,0.15);border-radius:4px;padding:18px;text-align:center;margin-bottom:20px;}
.deadline-title{font-size:0.75rem;letter-spacing:2px;text-transform:uppercase;color:var(--text-mid);margin-bottom:12px;}
.cd-row{display:flex;justify-content:center;gap:8px;}
.cd-item{text-align:center;min-width:48px;}
.cd-num{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-accent);}
.cd-lbl{font-size:0.62rem;letter-spacing:1px;text-transform:uppercase;color:var(--text-mid);}

/* SUBMIT */
.submit-section{margin-top:25px;display:flex;gap:12px;flex-wrap:wrap;align-items:center;}
.btn{padding:13px 28px;border:none;cursor:pointer;font-family:'Cormorant Garamond',serif;font-size:0.88rem;letter-spacing:2px;text-transform:uppercase;border-radius:3px;transition:all 0.3s;display:inline-flex;align-items:center;gap:8px;}
.btn-primary{background:var(--brown-accent);color:#fff;box-shadow:0 4px 15px rgba(155,90,45,0.3);}
.btn-primary:hover{background:var(--brown-mid);transform:translateY(-2px);}
.btn-outline{background:transparent;color:var(--brown-accent);border:1px solid var(--brown-accent);}
.btn-outline:hover{background:var(--brown-accent);color:#fff;}
.save-note{font-size:0.82rem;color:var(--text-mid);}
.save-note i{color:var(--gold);margin-right:4px;}

/* FILE UPLOAD */
.file-drop{
  border:2px dashed rgba(180,140,100,0.35);border-radius:4px;padding:30px;
  text-align:center;cursor:pointer;transition:all 0.3s;background:var(--cream);
}
.file-drop:hover,.file-drop.dragover{border-color:var(--brown-accent);background:rgba(155,90,45,0.05);}
.file-drop i{font-size:2rem;color:var(--gold);margin-bottom:10px;display:block;}
.file-drop p{font-size:0.9rem;color:var(--text-mid);}
.file-drop span{color:var(--brown-accent);text-decoration:underline;}

/* SUCCESS */
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

<nav>
  <a href="index.php" class="logo">BOOK ADVISOR</a>
  <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="browse_books.php">Shop</a></li>
    <li><a href="competitions.php">Competitions</a></li>
  </ul>
  <a href="profile.php" style="color:var(--text-mid);text-decoration:none;font-size:0.82rem;letter-spacing:1px;text-transform:uppercase;"><i class="fa fa-user"></i> Account</a>
</nav>

<div class="page-hero">
  <div class="hero-badge"><i class="fa fa-trophy" style="color:var(--gold);margin-right:6px;"></i> Essay Competition 2025</div>
  <h1>Submit Your Essay</h1>
  <p>The Art of Storytelling — "Stories that Changed the World"</p>
</div>

<div class="layout">

  <!-- MAIN FORM -->
  <div>
    <div class="card">
      <div class="card-header"><h2>Your Essay Submission</h2></div>
      <div class="card-body">
        <form id="essayForm">
          <div class="form-group">
            <label>Essay Title <span>Required</span></label>
            <input type="text" placeholder="Enter a compelling title for your essay..." required maxlength="100" id="titleInp">
          </div>

          <div class="form-group">
            <label>Author Name</label>
            <input type="text" value="Ahmad Khan" readonly style="background:rgba(155,90,45,0.05);">
          </div>

          <div class="form-group">
            <label>Essay Content <span id="wc-label">0 / 2000 words</span></label>
            <div class="editor-wrap">
              <div class="editor-toolbar">
                <button type="button" class="toolbar-btn" onclick="fmt('bold')" title="Bold"><i class="fa fa-bold"></i></button>
                <button type="button" class="toolbar-btn" onclick="fmt('italic')" title="Italic"><i class="fa fa-italic"></i></button>
                <button type="button" class="toolbar-btn" onclick="fmt('underline')" title="Underline"><i class="fa fa-underline"></i></button>
                <div class="toolbar-sep"></div>
                <button type="button" class="toolbar-btn" onclick="fmt('justifyLeft')" title="Align Left"><i class="fa fa-align-left"></i></button>
                <button type="button" class="toolbar-btn" onclick="fmt('justifyCenter')" title="Center"><i class="fa fa-align-center"></i></button>
                <button type="button" class="toolbar-btn" onclick="fmt('justifyFull')" title="Justify"><i class="fa fa-align-justify"></i></button>
                <div class="toolbar-sep"></div>
                <button type="button" class="toolbar-btn" onclick="fmt('insertUnorderedList')" title="Bullet List"><i class="fa fa-list-ul"></i></button>
                <button type="button" class="toolbar-btn" onclick="fmt('insertOrderedList')" title="Numbered List"><i class="fa fa-list-ol"></i></button>
                <div class="toolbar-sep"></div>
                <button type="button" class="toolbar-btn" onclick="fmt('undo')" title="Undo"><i class="fa fa-undo"></i></button>
                <button type="button" class="toolbar-btn" onclick="fmt('redo')" title="Redo"><i class="fa fa-repeat"></i></button>
              </div>
              <div class="editor-area" contenteditable="true" id="essayEditor" oninput="updateWC()" placeholder="Begin your literary journey here..."></div>
              <div class="word-count-bar">
                <span id="wc-text">0 words</span>
                <div class="wc-progress"><div class="wc-fill" id="wcFill" style="width:0%"></div></div>
                <span>Max: 2000 words</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Supporting Document (Optional)</label>
            <div class="file-drop" onclick="document.getElementById('fileInp').click()" ondragover="this.classList.add('dragover');event.preventDefault();" ondragleave="this.classList.remove('dragover');" ondrop="this.classList.remove('dragover');event.preventDefault();">
              <i class="fa fa-cloud-upload"></i>
              <p>Drag & drop your file here, or <span>browse</span></p>
              <p style="font-size:0.78rem;margin-top:5px;">PDF, DOC, DOCX — Max 5MB</p>
              <input type="file" id="fileInp" style="display:none;" accept=".pdf,.doc,.docx" onchange="showFile(this)">
              <div id="fileDisplay" style="margin-top:10px;font-size:0.85rem;color:var(--brown-accent);"></div>
            </div>
          </div>

          <div class="form-group">
            <label>Brief Bio <span>Max 150 words</span></label>
            <textarea placeholder="Tell us a bit about yourself as a writer..." rows="3" maxlength="900"></textarea>
          </div>

          <div class="form-group">
            <label style="align-items:center;gap:8px;cursor:pointer;flex-direction:row;">
              <input type="checkbox" required style="accent-color:var(--brown-accent);"> 
              I agree that this is my original work and I have the rights to submit it
            </label>
          </div>

          <div class="submit-section">
            <button type="button" class="btn btn-primary" onclick="submitEssay()"><i class="fa fa-paper-plane"></i> Submit Essay</button>
            <button type="button" class="btn btn-outline"><i class="fa fa-save"></i> Save Draft</button>
            <span class="save-note"><i class="fa fa-shield"></i> Submissions are secure & confidential</span>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- SIDEBAR -->
  <div>
    <div class="card guidelines-card" style="margin-bottom:20px;">
      <div class="card-header"><h2>Prize</h2></div>
      <div class="card-body" style="padding-top:15px;">
        <div class="prize-display">
          <div class="prize-icon">🏆</div>
          <div class="prize-amount">$500</div>
          <div class="prize-label">First Place Prize</div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
          <div style="text-align:center;padding:12px;background:var(--cream);border-radius:3px;">
            <div style="font-family:'Playfair Display',serif;color:var(--brown-accent);">$250</div>
            <div style="font-size:0.75rem;color:var(--text-mid);text-transform:uppercase;letter-spacing:1px;">2nd Place</div>
          </div>
          <div style="text-align:center;padding:12px;background:var(--cream);border-radius:3px;">
            <div style="font-family:'Playfair Display',serif;color:var(--brown-accent);">$100</div>
            <div style="font-size:0.75rem;color:var(--text-mid);text-transform:uppercase;letter-spacing:1px;">3rd Place</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card guidelines-card" style="margin-bottom:20px;">
      <div class="card-header"><h2>Deadline</h2></div>
      <div class="card-body">
        <div class="deadline-box">
          <div class="deadline-title">Time Remaining</div>
          <div class="cd-row" id="sidebar-cd"></div>
        </div>
        <div style="font-size:0.85rem;color:var(--text-mid);text-align:center;"><i class="fa fa-calendar" style="color:var(--gold);margin-right:5px;"></i> March 31, 2025</div>
      </div>
    </div>

    <div class="card guidelines-card">
      <div class="card-header"><h2>Guidelines</h2></div>
      <div class="card-body">
        <div class="guideline-item">
          <div class="guideline-icon"><i class="fa fa-file-text-o"></i></div>
          <div><div class="guideline-title">Word Limit</div><div class="guideline-desc">500 – 2000 words. Quality over quantity.</div></div>
        </div>
        <div class="guideline-item">
          <div class="guideline-icon"><i class="fa fa-tag"></i></div>
          <div><div class="guideline-title">Theme</div><div class="guideline-desc">"Stories that Changed the World" — explore literature's impact.</div></div>
        </div>
        <div class="guideline-item">
          <div class="guideline-icon"><i class="fa fa-star"></i></div>
          <div><div class="guideline-title">Originality</div><div class="guideline-desc">Must be your original, unpublished work.</div></div>
        </div>
        <div class="guideline-item">
          <div class="guideline-icon"><i class="fa fa-language"></i></div>
          <div><div class="guideline-title">Language</div><div class="guideline-desc">English only. No plagiarism permitted.</div></div>
        </div>
        <div class="guideline-item">
          <div class="guideline-icon"><i class="fa fa-trophy"></i></div>
          <div><div class="guideline-title">Judging</div><div class="guideline-desc">Judged on creativity, clarity, and literary merit.</div></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SUCCESS OVERLAY -->
<div class="success-overlay" id="successOverlay">
  <div class="success-box">
    <div class="success-icon"><i class="fa fa-check"></i></div>
    <h2>Essay Submitted!</h2>
    <p>Your essay has been received. Our panel of judges will review all submissions after the deadline. Winners will be announced via email.</p>
    <div style="font-family:'Playfair Display',serif;font-size:1rem;color:var(--text-mid);margin-bottom:20px;">Submission ID: <span style="color:var(--brown-accent);">ESS-2025-0089</span></div>
    <a href="competitions.php" class="btn-back"><i class="fa fa-trophy"></i> View All Competitions</a>
  </div>
</div>

<footer>
  <div class="footer-grid">
    <div class="footer-brand"><h3>BOOK ADVISOR</h3><p>Curating the finest stories for the modern reader.</p></div>
    <div class="footer-col"><h4>Quick Links</h4><a href="index.php">Home</a><a href="browse_books.php">Shop</a><a href="competitions.php">Competitions</a></div>
    <div class="footer-col"><h4>Connect</h4><p>support@bookadvisor.com</p><p>+1 234 567 890</p></div>
  </div>
  <div class="footer-bottom">© 2025 Book Advisor. All Rights Reserved.</div>
</footer>

<script>
function fmt(cmd){document.execCommand(cmd,false,null);}
function updateWC(){
  const text=document.getElementById('essayEditor').innerText;
  const words=text.trim()?text.trim().split(/\s+/).length:0;
  document.getElementById('wc-text').textContent=words+' words';
  document.getElementById('wc-label').textContent=words+' / 2000 words';
  const pct=Math.min(words/2000*100,100);
  document.getElementById('wcFill').style.width=pct+'%';
  document.getElementById('wcFill').style.background=pct>90?'#c0392b':'var(--brown-accent)';
}
function showFile(inp){
  if(inp.files.length)document.getElementById('fileDisplay').innerHTML='<i class="fa fa-check-circle"></i> '+inp.files[0].name;
}
function submitEssay(){
  const title=document.getElementById('titleInp').value;
  const content=document.getElementById('essayEditor').innerText;
  if(!title){alert('Please enter an essay title.');return;}
  if(content.trim().split(/\s+/).length<50){alert('Please write at least 50 words.');return;}
  document.getElementById('successOverlay').style.display='flex';
}
document.getElementById('successOverlay').addEventListener('click',function(e){if(e.target===this)this.style.display='none';});

// Countdown
function buildCD(id, deadline) {
  const el = document.getElementById(id);
  function update() {
    const diff = new Date(deadline) - new Date();
    if(diff<=0){el.innerHTML='Expired';return;}
    const d=Math.floor(diff/86400000),h=Math.floor((diff%86400000)/3600000),m=Math.floor((diff%3600000)/60000);
    el.innerHTML=`<div class="cd-item"><div class="cd-num">${d}</div><div class="cd-lbl">Days</div></div><div class="cd-item"><div class="cd-num">${h}</div><div class="cd-lbl">Hrs</div></div><div class="cd-item"><div class="cd-num">${m}</div><div class="cd-lbl">Min</div></div>`;
  }
  update();setInterval(update,60000);
}
buildCD('sidebar-cd','2025-03-31');
</script>
</body>
</html>
