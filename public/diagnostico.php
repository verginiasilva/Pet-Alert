<?php
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__ . '/../config/database.php';

echo '<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><title>Diagnóstico PetAlert</title>';
echo '<style>body{font-family:sans-serif;background:#FFF9F5;color:#2D2522;padding:2rem;} .card{background:#fff;padding:2rem;border-radius:16px;max-width:650px;margin:auto;box-shadow:0 10px 30px rgba(0,0,0,0.08);} .ok{color:#15803d;background:#dcfce7;padding:1rem;border-radius:10px;font-weight:bold;} .erro{color:#b91c1c;background:#fee2e2;padding:1rem;border-radius:10px;font-weight:bold;margin-bottom:1rem;} code{background:#eee;padding:2px 6px;border-radius:4px;}</style></head><body>';
echo '<div class="card">';
echo '<h2>🐾 Diagnóstico de Conexão com o Banco de Dados</h2>';

try {
    $db = Database::getConnection();
    echo '<div class="ok">✅ Conexão com o MySQL realizada com SUCESSO!</div>';
    
    // Contagem de pets
    $stmt = $db->query("SELECT COUNT(*) as total FROM tb_animal");
    $total = $stmt->fetchColumn();
    echo "<p>Total de pets cadastrados na tabela <code>tb_animal</code>: <strong>{$total}</strong></p>";

    $stmtFotos = $db->query("SELECT COUNT(*) as total FROM tb_pet_fotos");
    $totalFotos = $stmtFotos->fetchColumn();
    echo "<p>Total de fotos na tabela <code>tb_pet_fotos</code>: <strong>{$totalFotos}</strong></p>";

    echo '<p><a href="pets/index.html" style="display:inline-block;padding:10px 20px;background:#ff7a00;color:#fff;text-decoration:none;border-radius:8px;font-weight:bold;">Ir para a página de Pets</a></p>';
} catch (Throwable $e) {
    echo '<div class="erro">❌ Falha na conexão com o banco de dados</div>';
    echo '<p><strong>Mensagem do MySQL:</strong></p>';
    echo '<pre style="background:#f8fafc;padding:1rem;border:1px solid #e2e8f0;border-radius:8px;white-space:pre-wrap;color:#b91c1c;">' . htmlspecialchars($e->getMessage()) . '</pre>';
    
    echo '<hr style="border:0;border-top:1px solid #eee;margin:1.5rem 0;">';
    echo '<h3>Como resolver no painel da InfinityFree:</h3>';
    echo '<ol style="line-height:1.7;">';
    echo '<li>Acesse a sua conta no <a href="https://dash.infinityfree.com/" target="_blank">painel da InfinityFree</a>.</li>';
    echo '<li>Abra a conta <strong>if0_43477064</strong> (petalert.free.je).</li>';
    echo '<li>Veja em <strong>Account Details</strong> o campo <strong>Password</strong> (clique em "Show" para ver a senha correta).</li>';
    echo '<li>Se a senha for diferente de <code>Robpri02</code>, atualize no arquivo <code>config/database.php</code> ou no arquivo <code>.env</code>.</li>';
    echo '</ol>';
}

echo '</div></body></html>';
