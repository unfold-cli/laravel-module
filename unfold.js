module.exports = {
    name: 'laravel-module',
    variables() {
        return [
            'author_name',
            'author_username',
            'author_email',
            'vendor_name',
            'package_name',
            'package_description',
        ];
    },
    prompts() {
        return [
            { type: 'input', name: 'author_name', message: "What's your name?" },
            { type: 'input', name: 'author_username', message: "What's your username?" },
            { type: 'input', name: 'author_email', message: "What's your email?" },
            { type: 'input', name: 'vendor_name', message: "What's your vendor name (e.g. Great Company)?" },
            { type: 'input', name: 'package_name', message: "What's your package name (e.g. The Great Package)?" },
            { type: 'input', name: 'resource_name', message: "What's your resource (model) name?" },
            { type: 'input', name: 'package_description', message: "What's your package description??" },
        ];
    },
    replacements: [
        { replace: "StubModel", with: '{{studly_case resource_name}}' },
        { replace: "StubModels", with: '{{pluralize studly_case resource_name}}' },
        { replace: "stub_model", with: '{{snake_case resource_name}}' },
        { replace: "stub_models", with: '{{pluralize snake_case resource_name}}' },
        { replace: "stub-package", with: '{{kebab_case package_name}}' },
        { replace: "stub_package", with: '{{snake_case package_name}}' },
        { replace: "StubModel", with: '{{studly_case package_name}}' },
        { replace: "stub-vendor", with: '{{kebab_case vendor_name}}' },
        { replace: "StubVendor", with: '{{studly_case vendor_name}}' },
        { replace: "StubPackages", with: '{{pluralize studly_case package_name }}' },
        { replace: "stub_packages", with: '{{pluralize snake_case package_name }}' },
        { replace: "stub-packages", with: '{{pluralize kebab_case package_name }}' },
    ]
};
