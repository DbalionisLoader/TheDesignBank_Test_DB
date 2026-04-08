# Simple Wordpress Docker Install

**!! Important make sure that docker deamon is installed and working !!**

---

Using terminal/console, navigate to the folder you want to have Wordpress in and git clone this repository

**SSH** `git clone git@github.com:designbankdb/TheDesignBank.git .`

**HTTPS** `git clone https://github.com/designbankdb/TheDesignBank.git . `

---

Change the 'Volumes' in the 'compose.yml' to link your local folders with those on the docker image.  Run `docker-compose up` this will build the containers, and install WordPress in your local folder. 

Once this has completed you should be able to setup the WordPress site on http://localhost:8080/

---

# The Challenge

In the project folder there is a Figma file to take styling from, the font is included, but it is your decision how you import this.

1. Create a simple WordPress website with the homepage designed.  
2. There should also be a contact form as the designed page, feel free to use whichever form plugin, or custom code, you wish.  The map should work. 
3. The form should be integrated into a Google sheet.  When submissions are sent to the form they should be stored in the Google sheet. 

On completion, submit the GitHub or Bitbucket link to web@thedesignbank.co.uk and invite the same email address to the Google sheet.

Use Git as you would normally, committing when you would normally, branching if necessary.

If there are any questions, please reach out to web@thedesignbank.co.uk 
