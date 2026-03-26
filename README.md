# Rosary Helper

A Drupal 10 project demonstrating a CI/CD pipeline with automated testing using Behat.

## Purpose

This project was built to demonstrate how to properly integrate automated testing
into a Drupal project from day one -- addressing a common gap in legacy Drupal 
codebases where test automation is added as an afterthought, if at all.

## Pipeline

The GitHub Actions pipeline runs on every push to `main` and includes:

1. **Install dependencies** -- Composer installs Behat, Drush, and the Drupal extension
2. **Install Drupal** -- Drush bootstraps a fresh Drupal site against a clean database
3. **Seed test content** -- A PHP script creates the minimum content needed for tests
4. **Run Behat** -- Automated behavior tests verify the site works as expected

If any stage fails, the pipeline stops. No broken code reaches production.

## Local Development

### Requirements
- Docker
- Docker Compose

### Setup
```bash
docker compose up -d
```

Visit `http://localhost:8080` to see the site.

## Testing

Run the full Behat suite locally:

```bash
behat
```

Tests are written in Gherkin and live in the `features/` directory. Each scenario
describes expected user-facing behavior and is independent -- test content is
created fresh for each pipeline run via Drush.

## Notes

### Why Behat

Behat is the standard testing tool for Drupal projects and integrates directly
with Drupal's user and content systems via the Drupal Extension. It allows tests
to be written in plain language that non-developers can read and verify.

### Pipeline Design

This pipeline is designed to be stateless -- it installs Drupal from scratch on
every run rather than relying on a database dump. This avoids storing sensitive
data in version control while keeping the test environment reproducible.

In a production scenario, a database dump would be pulled from secure storage
(e.g. S3 or a secrets vault) to preserve real configuration and content types
before running tests.

### Test Suite Performance

Behat test suites on large Drupal projects can take significant time to run --
hours in some cases -- due to the overhead of browser automation, database
operations, and the sheer volume of scenarios.

This pipeline does not address test suite performance directly. Strategies for
reducing run time on large suites include:

- **Parallel test execution** -- splitting the suite across multiple runners
- **Tagging and filtering** -- running only tests relevant to changed code
- **Headless browsers** -- faster than full browser automation for non-JavaScript scenarios
- **Test suite triage** -- identifying and removing redundant or low-value scenarios

For this project the suite is intentionally small and runs in seconds. Scaling
it to a production-sized suite would require revisiting the pipeline architecture.