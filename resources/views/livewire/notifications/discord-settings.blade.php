<div>
    <form wire:submit.prevent='submit' class="flex flex-col">
        <div class="flex items-center gap-2">
            <h2>Discord</h2>
            <x-forms.button type="submit">
                Save
            </x-forms.button>
            @if ($team->discord_enabled)
                <x-forms.button class="text-white normal-case btn btn-xs no-animation btn-primary"
                    wire:click="sendTestNotification">
                    Send Test Notifications
                </x-forms.button>
            @endif
        </div>
        <div class="w-48">
            <x-forms.checkbox instantSave id="team.discord_enabled" label="Notification Enabled" />
        </div>
        <x-forms.input type="password"
            helper="Generate a webhook in Discord.<br>Example: https://discord.com/api/webhooks/...." required
            id="team.discord_webhook_url" label="Webhook" />
    </form>
    @if (data_get($team, 'discord_enabled'))
        <h2 class="mt-4">Subscribe to events</h2>
        <div class="w-64">


            @if (isDev())
            <h3 class="mt-4">Test</h3>
            <div class="flex items-end gap-10">
                <x-forms.checkbox instantSave="saveModel" id="team.discord_notifications_test" label="Enabled" />
            </div>
            @endif
            <h3 class="mt-4">Container Status Changes</h3>
            <div class="flex items-end gap-10">
                <x-forms.checkbox instantSave="saveModel" id="team.discord_notifications_status_changes"
                label="Enabled" />
            </div>
            <h3 class="mt-4">Application Deployments</h3>
            <div class="flex items-end gap-10">
                <x-forms.checkbox instantSave="saveModel" id="team.discord_notifications_deployments"
                label="Enabled" />
            </div>
            <h3 class="mt-4">Backup Status</h3>
            <div class="flex items-end gap-10">
                <x-forms.checkbox instantSave="saveModel" id="team.discord_notifications_database_backups"
                label="Enabled" />
            </div>
        </div>
    @endif
</div>
