<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Everlee AI Evolution - Core Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration powers the Everlee AI Evolution system which controls
    | feature building, Claude ↔ GPT collaboration, prompt safety, staging,
    | automated digests, rollback system, and more.
    |
    */

    'enabled' => true,

    'mode' => env('EVERLEE_MODE', 'production'), // production | staging | dry-run

    'ai_providers' => [
        'openai' => [
            'enabled' => true,
            'key' => env('OPENAI_API_KEY'),
            'model' => env('OPENAI_MODEL', 'gpt-4'),
        ],
        'claude' => [
            'enabled' => true,
            'key' => env('CLAUDE_API_KEY'),
            'model' => env('CLAUDE_MODEL', 'claude-3-sonnet-20240229'),
        ],
    ],

    'collaboration_mode' => env('AI_COLLAB_MODE', 'hybrid'), // hybrid | gpt-only | claude-only

    'memory' => [
        'enabled' => true,
        'project_path' => storage_path('app/everlee/memory/project.json'),
        'branding_path' => storage_path('app/everlee/memory/branding.json'),
        'folder_tree' => true,
        'summary_injection' => true,
    ],

    'staging' => [
        'enabled' => true,
        'path' => base_path('everlee/staging/self-upgrades'),
        'git_controlled' => true,
        'simulate_first' => true,
        'wait_for_admin_to_deploy' => true,
    ],

    'logs' => [
        'path' => storage_path('logs/everlee'),
        'access_log_enabled' => true,
        'log_rotation_days' => 30,
        'allow_download' => true,
        'auto_cleanup' => true,
        'snapshot_log_prefix' => 'everlee-log-',
    ],

    'features' => [
        'self_upgrade_engine' => true,
        'prompt_safety_filter' => true,
        'feature_size_classifier' => true,
        'retry_and_fallback_system' => true,
        'weekly_digest_generator' => true,
        'ghost_mode_suggestions' => true,
        'ab_test_suggestions' => true,
        'local_simulation_mode' => true,
        'snapshot_and_rollback' => true,
        'live_conversation_viewer' => true,
        'visual_progress_bar' => true,
        'file_lock_registry' => true,
        'knowledge_base_enabled' => true,
    ],

    'admin_controls' => [
        'require_approval_before_deploy' => true,
        'notify_on_completion' => true,
        'override_toggle_per_feature' => true,
        'system_lockdown_mode' => false,
    ],

    'ui' => [
        'branding_logo' => '/storage/branding/logo.png',
        'audit_panel_position' => 'right',
        'theme_color' => '#6366F1',
        'progress_chart' => true,
    ],

    'digest' => [
        'enabled' => true,
        'send_to_admin' => true,
        'include_failures' => true,
        'include_suggestions' => true,
        'log_path' => storage_path('logs/everlee/weekly-digests'),
    ],

];
