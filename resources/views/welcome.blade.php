<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Developer Team</title>
  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #ffffff; /* white */
      color: #064e03; /* dark green */
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
    }

    h1 {
      margin-bottom: 30px;
      font-weight: 700;
      font-size: 2.8rem;
      letter-spacing: 1.5px;
      color: #064e03;
    }

    .team-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 30px;
      width: 100%;
      max-width: 1000px;
    }

    .developer-card {
      background: #f7faf6;
      border: 2px solid #064e03;
      border-radius: 16px;
      padding: 20px;
      text-align: center;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(6, 78, 3, 0.1);
    }

    .developer-card:hover {
      background: #064e03;
      color: #fff;
      box-shadow: 0 8px 15px rgba(6, 78, 3, 0.4);
      transform: translateY(-6px);
    }

    .avatar {
      width: 120px;
      height: 120px;
      margin: 0 auto 15px;
      border-radius: 50%;
      background-color: #a0d468;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      box-shadow: 0 3px 6px rgba(6, 78, 3, 0.2);
      transition: background-color 0.3s ease;
    }

    .developer-card:hover .avatar {
      background-color: #8bc34a;
    }

    /* Simple cartoon avatars as inline SVG for each dev */

    .avatar svg {
      width: 80px;
      height: 80px;
      fill: #064e03;
      filter: drop-shadow(1px 1px 0 #a0d468);
      transition: filter 0.3s ease;
    }

    .developer-card:hover .avatar svg {
      fill: #e0f2f1;
      filter: drop-shadow(0 0 4px #dcedc8);
    }

    .name {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 6px;
    }

    .role {
      font-size: 1rem;
      color: #377d12;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .developer-card:hover .role {
      color: #c8e6c9;
    }
  </style>
</head>
<body>
  <h1>Supreme Gym developer</h1>
  <div class="team-container">
    <div class="developer-card" tabindex="0">
      <div class="avatar" aria-label="Cartoon avatar of Alice">
        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <circle cx="32" cy="32" r="30" />
          <circle cx="24" cy="24" r="8" fill="#fff" />
          <circle cx="40" cy="24" r="8" fill="#fff" />
          <circle cx="24" cy="24" r="4" fill="#064e03" />
          <circle cx="40" cy="24" r="4" fill="#064e03" />
          <path d="M20 44c4 6 24 6 28 0" stroke="#064e03" stroke-width="3" fill="none" stroke-linecap="round" />
        </svg>
      </div>
      <div class="name">Thet Paing OO</div>
      <div class="role">Frontend Developer</div>
    </div>

    <div class="developer-card" tabindex="0">
      <div class="avatar" aria-label="Cartoon avatar of Bob">
        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <circle cx="32" cy="32" r="30" />
          <rect x="18" y="18" width="28" height="20" fill="#fff" />
          <circle cx="22" cy="28" r="5" fill="#064e03" />
          <circle cx="42" cy="28" r="5" fill="#064e03" />
          <path d="M22 42c4 5 20 5 24 0" stroke="#064e03" stroke-width="3" fill="none" stroke-linecap="round" />
        </svg>
      </div>
      <div class="name">Myo Thida Htun</div>
      <div class="role">Backend Developer</div>
    </div>

    <div class="developer-card" tabindex="0">
      <div class="avatar" aria-label="Cartoon avatar of Clara">
        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <circle cx="32" cy="32" r="30" />
          <ellipse cx="32" cy="24" rx="14" ry="10" fill="#fff" />
          <circle cx="25" cy="24" r="5" fill="#064e03" />
          <circle cx="39" cy="24" r="5" fill="#064e03" />
          <path d="M20 44c6 6 24 6 28 0" stroke="#064e03" stroke-width="3" fill="none" stroke-linecap="round" />
        </svg>
      </div>
      <div class="name">Thit San</div>
      <div class="role">UI/UX Designer</div>
    </div>

    <div class="developer-card" tabindex="0">
      <div class="avatar" aria-label="Cartoon avatar of David">
        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <circle cx="32" cy="32" r="30" />
          <polygon points="22,18 42,18 32,42" fill="#fff" />
          <circle cx="24" cy="26" r="6" fill="#064e03" />
          <circle cx="40" cy="26" r="6" fill="#064e03" />
          <path d="M22 44c5 6 20 6 24 0" stroke="#064e03" stroke-width="3" fill="none" stroke-linecap="round" />
        </svg>
      </div>
      <div class="name">Thura Mon</div>
      <div class="role">Frontend Developer</div>
    </div>
  </div>
</body>
</html>
