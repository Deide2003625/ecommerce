<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AddAuditColumns extends Command
{
    protected $signature = 'db:add-audit-columns';
    protected $description = 'Ajoute les colonnes inserted_by et updated_by à toutes les tables sauf jobs et audits';

    public function handle()
    {
        $tables = collect(DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'"))
            ->pluck('tablename')
            ->toArray();
        $excluded = ['jobs', 'audits', 'password_reset_tokens', 'personal_access_tokens','migrations', 'cache_locks', 'cache','failed_jobs', 'job_batches', 'sessions', 'model_has_roles', 'permissions', 'model_has_permissions', 'role_has_permissions', 'media'];
        $count = 0;
        foreach ($tables as $table) {
            if (in_array($table, $excluded)) continue;
            Schema::table($table, function (Blueprint $tableBlueprint) use ($table) {
                if (!Schema::hasColumn($table, 'inserted_by')) {
                    $tableBlueprint->unsignedBigInteger('inserted_by')->nullable()->after('id');
                }
                if (!Schema::hasColumn($table, 'updated_by')) {
                    $tableBlueprint->unsignedBigInteger('updated_by')->nullable()->after('inserted_by');
                }
                if (!Schema::hasColumn($table, 'is_deleted')) {
                    $tableBlueprint->boolean('is_deleted')->default(false)->after('updated_by');
                }
            });
            $count++;
            $this->info("Colonnes ajoutées à la table: $table");
        }

        $this->info("Opération terminée. Colonnes ajoutées à $count tables.");
    }
}
