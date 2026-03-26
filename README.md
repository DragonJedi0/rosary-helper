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