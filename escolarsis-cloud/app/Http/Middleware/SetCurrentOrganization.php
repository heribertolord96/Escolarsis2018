<?php

namespace App\Http\Middleware;

use App\Services\OrganizationContext;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCurrentOrganization
{
    public function __construct(
        protected OrganizationContext $organizationContext,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $organizationId = $request->header('X-Organization-Id')
            ?? $request->query('organization_id')
            ?? $request->user()?->organization_id;

        $this->organizationContext->setById(
            $organizationId ? (int) $organizationId : null
        );

        return $next($request);
    }
}
