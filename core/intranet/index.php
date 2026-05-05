<?php
$projectsDir = '/var/www/projects';
$projects = [];

if (is_dir($projectsDir)) {
    $dirs = scandir($projectsDir);
    foreach ($dirs as $dir) {
        if ($dir !== '.' && $dir !== '..' && is_dir($projectsDir . '/' . $dir)) {
            $projects[] = $dir;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Devstack Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/style.css">
</head>
<body>

  <!-- Sidebar Navigation -->
  <aside class="sidebar">
    <div class="brand">
      <div class="brand-icon">
        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <div class="brand-name">Devstack</div>
    </div>

    <nav class="nav-menu">
      <a href="#" class="nav-item active" data-tab="dashboard">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        Dashboard
      </a>
      <a href="#projects-section" class="nav-item" data-tab="projects">
        <svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
        Projects
      </a>
    </nav>

    <div class="system-status-widget">
      <div class="status-row">
        <span class="status-label">Nginx Web Server</span>
        <div class="status-indicator"><div class="pulse"></div> Online</div>
      </div>
      <div class="status-row">
        <span class="status-label">PHP-FPM Backend</span>
        <div class="status-indicator"><div class="pulse"></div> Online</div>
      </div>
      <div class="status-row">
        <span class="status-label">MySQL Database</span>
        <div class="status-indicator"><div class="pulse"></div> Online</div>
      </div>
    </div>
  </aside>

  <!-- Main Content Area -->
  <main class="main-content">
    <header>
      <div class="page-title">
        <h1>Local Environment</h1>
        <p>Manage your running services and access dev tools</p>
      </div>
      <div class="header-actions">
        <button class="btn btn-primary" id="refresh-btn">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
          Refresh Status
        </button>
      </div>
    </header>

    <h2 class="section-title">Database & Cache Tools</h2>
    <section class="tools-grid">
      <a href="http://localhost:8081" class="tool-card" target="_blank">
        <div class="tool-icon">
          <svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
        </div>
        <div class="tool-info">
          <h3>Adminer <span class="status-badge">Available</span></h3>
          <p>Lightweight database management for MySQL, MariaDB, and PostgreSQL.</p>
        </div>
      </a>
      
      <a href="http://localhost:8082" class="tool-card" target="_blank">
        <div class="tool-icon">
          <svg viewBox="0 0 24 24"><path d="M3 3h18v18H3zM3 9h18M9 21V9"></path></svg>
        </div>
        <div class="tool-info">
          <h3>phpMyAdmin <span class="status-badge">Available</span></h3>
          <p>Full-featured web interface for MySQL administration.</p>
        </div>
      </a>

      <a href="http://localhost:8083" class="tool-card" target="_blank">
        <div class="tool-icon">
          <svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path><path d="M3 12v7"></path><path d="M21 12v7"></path></svg>
        </div>
        <div class="tool-info">
          <h3>pgAdmin <span class="status-badge">Available</span></h3>
          <p>Dedicated PostgreSQL administration interface.</p>
        </div>
      </a>

      <a href="http://localhost:8084" class="tool-card" target="_blank">
        <div class="tool-icon">
          <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
        </div>
        <div class="tool-info">
          <h3>Redis Commander <span class="status-badge">Available</span></h3>
          <p>Web UI to view, edit, and manage Redis databases.</p>
        </div>
      </a>

      <a href="http://localhost:8085" class="tool-card" target="_blank">
        <div class="tool-icon">
          <svg viewBox="0 0 24 24"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
        </div>
        <div class="tool-info">
          <h3>Mongo Express <span class="status-badge">Available</span></h3>
          <p>Web-based administrative interface for MongoDB.</p>
        </div>
      </a>
    </section>

    <h2 class="section-title">Utility Tools</h2>
    <section class="tools-grid">
      <a href="http://localhost:8025" class="tool-card" target="_blank">
        <div class="tool-icon">
          <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        </div>
        <div class="tool-info">
          <h3>Mailpit <span class="status-badge">Available</span></h3>
          <p>Email testing tool with a web interface to view captured emails.</p>
        </div>
      </a>

      <a href="http://localhost:15672" class="tool-card" target="_blank">
        <div class="tool-icon">
          <svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
        </div>
        <div class="tool-info">
          <h3>RabbitMQ <span class="status-badge">Available</span></h3>
          <p>Message broker management UI for queues and exchanges.</p>
        </div>
      </a>

      <a href="http://localhost:8983" class="tool-card" target="_blank">
        <div class="tool-icon">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </div>
        <div class="tool-info">
          <h3>Solr <span class="status-badge">Available</span></h3>
          <p>Enterprise search platform console and administration.</p>
        </div>
      </a>

      <a href="http://localhost:9001" class="tool-card" target="_blank">
        <div class="tool-icon">
          <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline><polyline points="7.5 19.79 7.5 14.6 3 12"></polyline><polyline points="21 12 16.5 14.6 16.5 19.79"></polyline><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
        </div>
        <div class="tool-info">
          <h3>MinIO <span class="status-badge">Available</span></h3>
          <p>S3-compatible object storage server web console.</p>
        </div>
      </a>
    </section>

    <h2 class="section-title" id="projects-section">Active Projects</h2>
    <section class="projects-grid">
      <?php if (empty($projects)): ?>
        <p>No projects found in the <code>projects/</code> directory.</p>
      <?php else: ?>
        <?php foreach ($projects as $project): ?>
        <div class="project-card">
          <div class="project-icon">🚀</div>
          <div class="project-details">
            <h3><?php echo htmlspecialchars($project); ?></h3>
            <a href="http://<?php echo htmlspecialchars($project); ?>.localhost" class="project-link" target="_blank">
              <?php echo htmlspecialchars($project); ?>.localhost
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>

  </main>

  <script src="/script.js"></script>
</body>
</html>
