<?php

namespace App\Services;

use App\Models\Organization;

class OrganizationContext
{
    protected ?Organization $organization = null;

    public function set(?Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function setById(?int $organizationId): void
    {
        if (! $organizationId) {
            $this->organization = null;

            return;
        }

        $this->organization = Organization::query()->find($organizationId);
    }

    public function get(): ?Organization
    {
        return $this->organization;
    }

    public function id(): ?int
    {
        return $this->organization?->id;
    }
}
