# Project Overview - David B.

Hello, welcome to my submission of the "The Design Bank" test website.

# Technical Decisions

I used template parts instead of blocks because ACF Pro is not available.
The form sends JSON data using wp_remote_post.
The POST request is sent to a Google Apps Script.
The script stores the submitted data in a Google Sheet.
Use one main style sheet for simplicity. Can use POST CSS to combine multiple CSS files for future builds.
Used slighly smaller heading font size on homepage, to try match the design dimension from figma for closely.
Safari testing was not completed for the local environment. Any layout issues may be related to element width, height, or form styling.

# Docker Setup Procedure

Just run:

1. docker compose up -d --build

The db should auto init from db/init
Core WordPress files should be hidden inside the container

# WordPress Admin Login Details

Site Title: The Print Bank

Username: admin
Password: spellcaster222

# Google Sheet Access

Google sheet link just incase.
https://docs.google.com/spreadsheets/d/1oOuqEk_CVQ8PB4jKRs03NunxQJzIrMkWlWQ8Dr9jJr8/edit?usp=sharing

# Simple Wordpress Docker Install

**!! Important make sure that docker deamon is installed and working !!**

---

Using terminal/console, navigate to the folder you want to have Wordpress in and git clone this repository

**SSH** `git clone git@github.com:designbankdb/TheDesignBank.git .`

**HTTPS** `git clone https://github.com/designbankdb/TheDesignBank.git . `

---

Change the 'Volumes' in the 'compose.yml' to link your local folders with those on the docker image. Run `docker-compose up` this will build the containers, and install WordPress in your local folder.

Once this has completed you should be able to setup the WordPress site on http://localhost:8080/

---

# The Challenge

In the project folder there is a Figma file to take styling from, the font is included, but it is your decision how you import this.

1. Create a simple WordPress website with the homepage designed. DONE
2. There should also be a contact form as the designed page, feel free to use whichever form plugin, or custom code, you wish. The map should work. DONE
3. The form should be integrated into a Google sheet. When submissions are sent to the form they should be stored in the Google sheet. DONE

On completion, submit the GitHub or Bitbucket link to web@thedesignbank.co.uk and invite the same email address to the Google sheet.

Use Git as you would normally, committing when you would normally, branching if necessary.

If there are any questions, please reach out to web@thedesignbank.co.uk
