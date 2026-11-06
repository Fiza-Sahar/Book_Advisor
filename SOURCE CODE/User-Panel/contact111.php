<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact - Book Advisor</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/font-awesome.min.css">
<style>
:root {
  --cream: #f5f0e8;
  --warm-white: #faf7f2;
  --brown-dark: #3d1f0d;
  --brown-mid: #7a3f1e;
  --brown-accent: #9b5a2d;
  --gold: #b8966e;
  --text-dark: #2a1810;
  --text-mid: #5c3d2e;
  --shadow: rgba(61,31,13,0.15);
}
* { margin:0; padding:0; box-sizing:border-box; }
body { background:var(--cream); font-family:'Cormorant Garamond',serif; color:var(--text-dark); }

/* ── NAV ── */
nav {
  background: var(--warm-white);
  padding: 18px 60px;
  display: flex; justify-content: space-between; align-items: center;
  border-bottom: 1px solid rgba(180,140,100,0.2);
  position: sticky; top: 0; z-index: 100;
  box-shadow: 0 2px 20px var(--shadow);
}
.logo { font-family:'Playfair Display',serif; font-size:1.3rem; color:var(--brown-dark); letter-spacing:2px; text-decoration:none; }
.nav-links { display:flex; gap:36px; list-style:none; }
.nav-links a {
  text-decoration:none; color:var(--text-mid); font-size:0.85rem;
  letter-spacing:2px; text-transform:uppercase; position:relative; transition:color 0.3s;
}
.nav-links a::after { content:''; position:absolute; bottom:-4px; left:0; width:0; height:1px; background:var(--brown-accent); transition:width 0.3s; }
.nav-links a:hover::after, .nav-links a.active::after { width:100%; }
.nav-links a:hover, .nav-links a.active { color:var(--brown-accent); }
.nav-icon { color:var(--text-mid); font-size:1.1rem; }

/* ── HERO ── */
.hero {
  position: relative;
  height: 320px;
  overflow: hidden;
  display: flex; align-items: center; justify-content: center;
}
.hero-bg {
  position: absolute; inset: 0;
  background: url('https://images.unsplash.com/photo-1490750967868-88df5691cc06?w=1600&q=80') center/cover no-repeat;
  transform: scale(1.05);
  transition: transform 8s ease;
}
.hero:hover .hero-bg { transform: scale(1); }
.hero-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to bottom, rgba(30,10,5,0.55) 0%, rgba(30,10,5,0.4) 50%, rgba(245,240,232,0.15) 100%);
}
.hero-content { position: relative; text-align: center; z-index: 2; }
.hero-tag {
  display: inline-block; padding: 5px 20px;
  border: 1px solid rgba(255,255,255,0.35); border-radius: 30px;
  color: rgba(255,255,255,0.75); font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase;
  margin-bottom: 16px;
  animation: fadeDown 0.8s ease both;
}
.hero-content h1 {
  font-family: 'Playfair Display', serif;
  font-size: 3.4rem; color: var(--gold); letter-spacing: 4px;
  text-shadow: 0 3px 20px rgba(0,0,0,0.5);
  animation: fadeDown 0.8s 0.15s ease both;
}
.hero-content p {
  color: rgba(255,255,255,0.75); font-size: 1.1rem; margin-top: 10px; letter-spacing: 1px;
  animation: fadeDown 0.8s 0.3s ease both;
}
@keyframes fadeDown { from { opacity:0; transform:translateY(-20px); } to { opacity:1; transform:translateY(0); } }
@keyframes fadeUp   { from { opacity:0; transform:translateY(30px);  } to { opacity:1; transform:translateY(0); } }

/* ── INFO STRIP ── */
.info-strip {
  background: var(--brown-dark);
  display: grid; grid-template-columns: repeat(3, 1fr);
  border-bottom: 3px solid var(--gold);
}
.info-item {
  display: flex; align-items: center; gap: 16px;
  padding: 22px 35px;
  border-right: 1px solid rgba(255,255,255,0.07);
  opacity: 0; animation: fadeUp 0.6s ease forwards;
  transition: background 0.3s;
  cursor: default;
}
.info-item:hover { background: rgba(255,255,255,0.04); }
.info-item:last-child { border-right: none; }
.info-item:nth-child(1) { animation-delay: 0.1s; }
.info-item:nth-child(2) { animation-delay: 0.2s; }
.info-item:nth-child(3) { animation-delay: 0.3s; }
.info-icon {
  width: 48px; height: 48px; border-radius: 50%;
  border: 1px solid rgba(184,150,110,0.35);
  display: flex; align-items: center; justify-content: center;
  color: var(--gold); font-size: 1.1rem; flex-shrink: 0;
  transition: all 0.3s;
}
.info-item:hover .info-icon { background: var(--gold); color: var(--brown-dark); border-color: var(--gold); }
.info-text h4 { font-family:'Playfair Display',serif; color: #fff; font-size: 0.95rem; margin-bottom: 3px; }
.info-text p  { color: rgba(255,255,255,0.5); font-size: 0.85rem; line-height: 1.5; }

/* ── MAIN SECTION ── */
.main-section {
  max-width: 1150px; margin: 70px auto; padding: 0 30px;
  display: grid; grid-template-columns: 1fr 1.3fr; gap: 55px;
  align-items: start;
}

/* LEFT SIDE */
.left-col { opacity: 0; animation: fadeUp 0.7s 0.2s ease forwards; }
.section-label {
  font-size: 0.72rem; letter-spacing: 3px; text-transform: uppercase;
  color: var(--gold); margin-bottom: 14px;
  display: flex; align-items: center; gap: 10px;
}
.section-label::before { content:''; display:block; width:30px; height:1px; background:var(--gold); }
.left-col h2 {
  font-family: 'Playfair Display', serif; font-size: 2.4rem;
  color: var(--brown-dark); line-height: 1.2; margin-bottom: 20px;
}
.left-col h2 em { color: var(--brown-accent); font-style: italic; }
.left-col > p { color: var(--text-mid); line-height: 1.9; font-size: 1.05rem; margin-bottom: 30px; }

.response-promise {
  background: var(--warm-white); border: 1px solid rgba(180,140,100,0.2);
  border-left: 4px solid var(--gold); border-radius: 0 4px 4px 0;
  padding: 18px 22px; margin-bottom: 30px;
  display: flex; gap: 14px; align-items: flex-start;
}
.response-promise i { color: var(--gold); font-size: 1.2rem; margin-top: 2px; }
.response-promise h4 { font-family:'Playfair Display',serif; color:var(--brown-dark); margin-bottom:4px; }
.response-promise p  { font-size: 0.88rem; color: var(--text-mid); line-height: 1.6; }

.faq-list { margin-top: 10px; }
.faq-item {
  border-bottom: 1px solid rgba(180,140,100,0.15);
  overflow: hidden;
}
.faq-q {
  display: flex; justify-content: space-between; align-items: center;
  padding: 14px 0; cursor: pointer;
  font-family: 'Playfair Display', serif; color: var(--brown-dark); font-size: 1rem;
  transition: color 0.3s;
}
.faq-q:hover { color: var(--brown-accent); }
.faq-q i { color: var(--gold); font-size: 0.85rem; transition: transform 0.3s; }
.faq-q.open i { transform: rotate(180deg); }
.faq-a {
  color: var(--text-mid); font-size: 0.93rem; line-height: 1.7;
  max-height: 0; overflow: hidden; transition: max-height 0.4s ease, padding 0.3s;
}
.faq-a.open { max-height: 200px; padding-bottom: 14px; }

/* RIGHT — FORM CARD */
.form-card {
  background: var(--warm-white);
  border: 1px solid rgba(180,140,100,0.18);
  border-radius: 6px;
  box-shadow: 0 8px 50px rgba(61,31,13,0.12), 0 2px 10px rgba(61,31,13,0.06);
  overflow: hidden;
  opacity: 0; animation: fadeUp 0.7s 0.35s ease forwards;
}
.form-card-header {
  background: linear-gradient(135deg, var(--brown-dark), var(--brown-mid));
  padding: 28px 32px; position: relative; overflow: hidden;
}
.form-card-header::before {
  content: '✉';
  position: absolute; right: 25px; top: 50%; transform: translateY(-50%);
  font-size: 5rem; opacity: 0.07; line-height: 1;
}
.form-card-header h3 { font-family:'Playfair Display',serif; color:#fff; font-size:1.4rem; margin-bottom:6px; }
.form-card-header p  { color: rgba(255,255,255,0.55); font-size: 0.88rem; letter-spacing: 0.5px; }
.form-card-body { padding: 32px; }

/* FORM */
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
.form-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; position: relative; }
.form-group.full { grid-column: 1/-1; }
.form-group label { font-size: 0.72rem; letter-spacing: 2px; text-transform: uppercase; color: var(--text-mid); }

.form-group input, .form-group textarea, .form-group select {
  padding: 13px 16px;
  border: 1px solid rgba(180,140,100,0.3);
  border-radius: 3px;
  background: var(--cream);
  font-family: 'Cormorant Garamond', serif;
  font-size: 1rem; color: var(--text-dark);
  outline: none; transition: all 0.35s;
  width: 100%;
}
.form-group input:focus, .form-group textarea:focus, .form-group select:focus {
  border-color: var(--brown-accent);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(155,90,45,0.1);
  transform: translateY(-1px);
}
.form-group textarea { resize: vertical; min-height: 130px; }

/* FLOATING LABEL EFFECT */
.float-wrap { position: relative; }
.float-wrap input, .float-wrap textarea {
  padding-top: 18px;
}
.float-label {
  position: absolute; left: 16px; top: 14px;
  font-size: 0.78rem; letter-spacing: 1px; text-transform: uppercase;
  color: rgba(92,61,46,0.55); pointer-events: none;
  transition: all 0.3s;
}
.float-wrap input:focus ~ .float-label,
.float-wrap input:not(:placeholder-shown) ~ .float-label,
.float-wrap textarea:focus ~ .float-label,
.float-wrap textarea:not(:placeholder-shown) ~ .float-label {
  top: 5px; font-size: 0.62rem; color: var(--brown-accent);
}

/* TOPIC CHIPS */
.topic-chips { display: flex; flex-wrap: wrap; gap: 8px; }
.topic-chip {
  padding: 7px 18px; border: 1px solid rgba(180,140,100,0.35); border-radius: 30px;
  font-size: 0.82rem; cursor: pointer; color: var(--text-mid);
  background: transparent; font-family: 'Cormorant Garamond', serif; transition: all 0.3s;
}
.topic-chip:hover, .topic-chip.sel { background: var(--brown-accent); color:#fff; border-color: var(--brown-accent); }

/* RATING */
.star-rating { display: flex; gap: 6px; }
.star { font-size: 1.5rem; color: rgba(180,140,100,0.3); cursor: pointer; transition: all 0.2s; }
.star:hover, .star.active { color: var(--gold); transform: scale(1.15); }

/* SUBMIT BUTTON */
.btn-submit {
  width: 100%; padding: 15px;
  background: var(--brown-accent); color: #fff; border: none; border-radius: 3px;
  font-family: 'Cormorant Garamond', serif; font-size: 1rem; letter-spacing: 3px; text-transform: uppercase;
  cursor: pointer; transition: all 0.35s; margin-top: 5px;
  display: flex; align-items: center; justify-content: center; gap: 10px;
  box-shadow: 0 5px 20px rgba(155,90,45,0.3);
  position: relative; overflow: hidden;
}
.btn-submit::before {
  content: '';
  position: absolute; top:0; left:-100%; width:100%; height:100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
  transition: left 0.5s;
}
.btn-submit:hover::before { left: 100%; }
.btn-submit:hover { background: var(--brown-mid); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(155,90,45,0.4); }
.btn-submit:active { transform: translateY(0); }

/* PRIVACY NOTE */
.privacy-note { display: flex; align-items: center; justify-content: center; gap: 7px; margin-top: 14px; color: var(--text-mid); font-size: 0.82rem; }

/* SUCCESS */
.success-msg {
  display: none;
  flex-direction: column; align-items: center; text-align: center;
  padding: 40px 20px;
  animation: fadeUp 0.5s ease;
}
.success-icon {
  width: 80px; height: 80px; border-radius: 50%;
  background: rgba(155,90,45,0.1);
  display: flex; align-items: center; justify-content: center;
  font-size: 2rem; color: var(--brown-accent); margin-bottom: 20px;
  animation: popIn 0.5s cubic-bezier(0.34,1.56,0.64,1);
}
@keyframes popIn { from{opacity:0;transform:scale(0.5);} to{opacity:1;transform:scale(1);} }
.success-msg h3 { font-family:'Playfair Display',serif; font-size:1.8rem; color:var(--brown-dark); margin-bottom:10px; }
.success-msg p  { color: var(--text-mid); line-height:1.7; max-width:320px; }

/* SOCIAL ROW */
.social-contact {
  margin-top: 40px; padding-top: 30px;
  border-top: 1px solid rgba(180,140,100,0.2);
  text-align: center;
}
.social-contact p { color: var(--text-mid); font-size: 0.88rem; letter-spacing: 1px; margin-bottom: 16px; text-transform: uppercase; }
.social-row { display: flex; justify-content: center; gap: 12px; }
.soc-btn {
  width: 44px; height: 44px; border-radius: 50%;
  border: 1px solid rgba(180,140,100,0.35);
  display: flex; align-items: center; justify-content: center;
  color: var(--text-mid); text-decoration: none; font-size: 1rem;
  transition: all 0.3s;
}
.soc-btn:hover { background: var(--brown-accent); color: #fff; border-color: var(--brown-accent); transform: translateY(-3px); }

/* MAP STRIP */
.map-strip {
  width: 100%; height: 220px;
  background: linear-gradient(135deg, var(--brown-dark) 0%, #5a2d0a 50%, var(--brown-mid) 100%);
  display: flex; align-items: center; justify-content: center;
  position: relative; overflow: hidden; margin-top: 70px;
}
.map-strip::before {
  content: '';
  position: absolute; inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.map-text { position: relative; text-align: center; }
.map-text i { font-size: 3rem; color: var(--gold); margin-bottom: 15px; display: block; }
.map-text h3 { font-family:'Playfair Display',serif; color:#fff; font-size:1.5rem; margin-bottom:6px; }
.map-text p  { color: rgba(255,255,255,0.55); font-size:0.9rem; }
.pin-pulse {
  display: inline-block;
  animation: pulse 2s infinite;
}
@keyframes pulse { 0%,100%{transform:scale(1);} 50%{transform:scale(1.15);} }

/* ── FOOTER ── */
footer { background: var(--brown-dark); color: rgba(255,255,255,0.6); padding: 50px 60px 30px; }
.footer-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 40px; margin-bottom: 40px; }
.footer-brand h3 { font-family:'Playfair Display',serif; color:var(--gold); letter-spacing:2px; margin-bottom:12px; }
.footer-brand p  { font-size:0.9rem; line-height:1.7; }
.footer-col h4   { color:var(--gold); letter-spacing:2px; font-size:0.8rem; text-transform:uppercase; margin-bottom:15px; }
.footer-col a    { display:block; color:rgba(255,255,255,0.6); text-decoration:none; margin-bottom:10px; font-size:0.9rem; transition:color 0.3s; }
.footer-col a:hover { color: var(--gold); }
.social-icons    { display:flex; gap:14px; margin-top:15px; }
.social-icons a  { width:36px; height:36px; border-radius:50%; border:1px solid rgba(255,255,255,0.2); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.6); text-decoration:none; transition:all 0.3s; }
.social-icons a:hover { border-color:var(--gold); color:var(--gold); }
.footer-bottom   { border-top:1px solid rgba(255,255,255,0.1); padding-top:20px; text-align:center; font-size:0.82rem; }

@media(max-width:768px) {
  nav { padding:15px 20px; }
  .main-section { grid-template-columns:1fr; }
  .info-strip { grid-template-columns:1fr; }
  .form-row { grid-template-columns:1fr; }
  .footer-grid { grid-template-columns:1fr; }
  .hero-content h1 { font-size:2.2rem; }
}
</style>
</head>
<body>

        <!-- NAVIGATION -->
<?php
include("./shared1/nav.php");
?>

<!-- HERO -->
<div class="hero">
  <div class="hero-bg"></div>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <div class="hero-tag"><i class="fa fa-envelope-o" style="margin-right:6px;"></i> We're Here For You</div>
    <h1>GET IN TOUCH</h1>
    <p>We'd love to hear from you.</p>
  </div>
</div>

<!-- INFO STRIP -->
<div class="info-strip">
  <div class="info-item">
    <div class="info-icon"><i class="fa fa-envelope-o"></i></div>
    <div class="info-text">
      <h4>Email Us</h4>
      <p>support@bookadvisor.com<br>Reply within 24 hours</p>
    </div>
  </div>
  <div class="info-item">
    <div class="info-icon"><i class="fa fa-phone"></i></div>
    <div class="info-text">
      <h4>Call Us</h4>
      <p>+1 234 567 890<br>Mon–Fri, 9am–6pm EST</p>
    </div>
  </div>
  <div class="info-item">
    <div class="info-icon"><i class="fa fa-map-marker"></i></div>
    <div class="info-text">
      <h4>Visit Us</h4>
      <p>The Literary House, 5th Ave<br>New York, NY 10001</p>
    </div>
  </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-section">

  <!-- LEFT -->
  <div class="left-col">
    <div class="section-label">Contact</div>
    <h2>Let's Start a <em>Conversation</em></h2>
    <p>Whether you have a question about an order, want to submit your writing, need help finding the perfect book, or simply want to share your love of literature — our team is always here to listen.</p>

    <div class="response-promise">
      <i class="fa fa-clock-o"></i>
      <div>
        <h4>Fast Response Guaranteed</h4>
        <p>We respond to every message within 24 hours, Monday through Friday. Weekend queries are answered first thing Monday morning.</p>
      </div>
    </div>

    <div class="faq-list">
      <div style="font-size:0.72rem;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:15px;">Frequently Asked</div>

      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          <span>How long does delivery take?</span>
          <i class="fa fa-chevron-down"></i>
        </div>
        <div class="faq-a">Standard delivery takes 3–5 business days. Express delivery gets your books to you in 1–2 days. Free shipping on all orders over $35.</div>
      </div>

      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          <span>Can I return a book I've purchased?</span>
          <i class="fa fa-chevron-down"></i>
        </div>
        <div class="faq-a">Absolutely. We offer a hassle-free 30-day return policy. Simply contact us and we'll arrange a free pickup for all eligible returns.</div>
      </div>

      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          <span>How do I submit to a competition?</span>
          <i class="fa fa-chevron-down"></i>
        </div>
        <div class="faq-a">Visit our Competitions page, select the contest you wish to enter, and use the dedicated submission form. Make sure your work is original and follows the word limits.</div>
      </div>

      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">
          <span>Do you offer book recommendations?</span>
          <i class="fa fa-chevron-down"></i>
        </div>
        <div class="faq-a">Yes! Our expert advisors are passionate readers. Tell us your favourite genres and we'll curate a personalised list just for you — completely free.</div>
      </div>
    </div>

    <div class="social-contact">
      <p>Or find us on social media</p>
      <div class="social-row">
        <a href="#" class="soc-btn"><i class="fa fa-facebook"></i></a>
        <a href="#" class="soc-btn"><i class="fa fa-instagram"></i></a>
        <a href="#" class="soc-btn"><i class="fa fa-twitter"></i></a>
        <a href="#" class="soc-btn"><i class="fa fa-linkedin"></i></a>
        <a href="#" class="soc-btn"><i class="fa fa-goodreads" style="font-size:0.85rem;"></i></a>
      </div>
    </div>
  </div>

  <!-- RIGHT — FORM -->
  <div class="form-card">
    <div class="form-card-header">
      <h3>Send Us a Message</h3>
      <p>Fill in the form below and we'll get back to you shortly</p>
    </div>
    <div class="form-card-body" id="formWrap">

      <form id="contactForm" onsubmit="handleSubmit(event)">

        <div class="form-row">
          <div class="form-group">
            <label>Your Name</label>
            <input type="text" placeholder="Ahmad Khan" required>
          </div>
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" placeholder="you@example.com" required>
          </div>
        </div>

        <div class="form-group">
          <label>Topic</label>
          <div class="topic-chips" id="topicChips">
            <button type="button" class="topic-chip sel" onclick="selTopic(this)">Order Issue</button>
            <button type="button" class="topic-chip" onclick="selTopic(this)">Book Recommendation</button>
            <button type="button" class="topic-chip" onclick="selTopic(this)">Competition</button>
            <button type="button" class="topic-chip" onclick="selTopic(this)">Returns</button>
            <button type="button" class="topic-chip" onclick="selTopic(this)">Other</button>
          </div>
        </div>

        <div class="form-group">
          <label>Phone (Optional)</label>
          <input type="tel" placeholder="+1 000 000 0000">
        </div>

        <div class="form-group">
          <label>Your Message</label>
          <textarea placeholder="How can we help you today? Please be as detailed as you like..." required id="msgArea" oninput="countChars(this)"></textarea>
          <div style="text-align:right;font-size:0.75rem;color:var(--text-mid);margin-top:4px;" id="charCount">0 characters</div>
        </div>

        <div class="form-group">
          <label>How would you rate your experience with us?</label>
          <div class="star-rating" id="stars">
            <span class="star" onclick="rateStar(1)">★</span>
            <span class="star" onclick="rateStar(2)">★</span>
            <span class="star" onclick="rateStar(3)">★</span>
            <span class="star" onclick="rateStar(4)">★</span>
            <span class="star" onclick="rateStar(5)">★</span>
          </div>
        </div>

        <div class="form-group" style="margin-bottom:5px;">
          <label style="flex-direction:row;align-items:center;gap:8px;cursor:pointer;">
            <input type="checkbox" style="accent-color:var(--brown-accent);">
            Subscribe to our literary newsletter
          </label>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fa fa-paper-plane"></i> Send Message
        </button>
        <div class="privacy-note">
          <i class="fa fa-shield" style="color:var(--gold);"></i>
          Your data is safe. We never share your information.
        </div>
      </form>

      <!-- SUCCESS STATE -->
      <div class="success-msg" id="successMsg">
        <div class="success-icon"><i class="fa fa-check"></i></div>
        <h3>Message Sent!</h3>
        <p>Thank you for reaching out. Our team will respond to your message within 24 hours.</p>
        <button onclick="resetForm()" style="margin-top:20px;padding:11px 28px;background:var(--brown-accent);color:#fff;border:none;border-radius:3px;font-family:'Cormorant Garamond',serif;font-size:0.85rem;letter-spacing:2px;text-transform:uppercase;cursor:pointer;transition:all 0.3s;" onmouseover="this.style.background='var(--brown-mid)'" onmouseout="this.style.background='var(--brown-accent)'">
          <i class="fa fa-envelope-o"></i> Send Another
        </button>
      </div>

    </div>
  </div>

</div>

<!-- MAP STRIP -->
<div class="map-strip">
  <div class="map-text">
    <span class="pin-pulse"><i class="fa fa-map-marker" style="font-size:2.8rem;color:var(--gold);display:block;margin-bottom:12px;"></i></span>
    <h3>The Literary House</h3>
    <p>5th Avenue, New York, NY 10001 · Mon–Fri 9am–6pm</p>
  </div>
</div>

<?php include("shared1/footer.php"); ?>

<script>
/* FAQ */
function toggleFaq(el) {
  const ans = el.nextElementSibling;
  const isOpen = ans.classList.contains('open');
  document.querySelectorAll('.faq-a').forEach(a=>a.classList.remove('open'));
  document.querySelectorAll('.faq-q').forEach(q=>q.classList.remove('open'));
  if (!isOpen) { ans.classList.add('open'); el.classList.add('open'); }
}

/* TOPIC CHIPS */
function selTopic(el) {
  document.querySelectorAll('.topic-chip').forEach(c=>c.classList.remove('sel'));
  el.classList.add('sel');
}

/* STAR RATING */
function rateStar(n) {
  document.querySelectorAll('.star').forEach((s,i)=>{
    s.classList.toggle('active', i < n);
  });
}
document.querySelectorAll('.star').forEach((s,i)=>{
  s.addEventListener('mouseover',()=>document.querySelectorAll('.star').forEach((st,j)=>st.style.color=j<=i?'var(--gold)':'rgba(180,140,100,0.3)'));
  s.addEventListener('mouseout',()=>document.querySelectorAll('.star').forEach(st=>st.style.color=st.classList.contains('active')?'var(--gold)':'rgba(180,140,100,0.3)'));
});

/* CHAR COUNT */
function countChars(el) {
  document.getElementById('charCount').textContent = el.value.length + ' characters';
}

/* FORM SUBMIT */
function handleSubmit(e) {
  e.preventDefault();
  const btn = document.querySelector('.btn-submit');
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Sending...';
  btn.style.opacity = '0.8';
  setTimeout(() => {
    document.getElementById('contactForm').style.display = 'none';
    const sm = document.getElementById('successMsg');
    sm.style.display = 'flex';
  }, 1600);
}
function resetForm() {
  document.getElementById('contactForm').style.display = 'block';
  document.getElementById('contactForm').reset();
  document.getElementById('successMsg').style.display = 'none';
  document.querySelector('.btn-submit').innerHTML = '<i class="fa fa-paper-plane"></i> Send Message';
  document.querySelector('.btn-submit').style.opacity = '1';
  document.getElementById('charCount').textContent = '0 characters';
  document.querySelectorAll('.star').forEach(s=>{s.classList.remove('active');s.style.color='';});
  document.querySelectorAll('.topic-chip').forEach((c,i)=>{c.classList.toggle('sel',i===0);});
}

/* SCROLL REVEAL */
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if(e.isIntersecting) {
      e.target.style.opacity = '1';
      e.target.style.transform = 'translateY(0)';
    }
  });
}, { threshold: 0.1 });
document.querySelectorAll('.faq-item, .response-promise').forEach(el => {
  el.style.opacity = '0'; el.style.transform = 'translateY(20px)';
  el.style.transition = 'all 0.5s ease';
  observer.observe(el);
});
</script>
</body>
</html>
