Hello Attila,

Congratulations! We would like to progress you to the next round.

We receive 100s of applications for any technical job we advertise. If you’re reading this, it means you’re one of the few on the shortlist for the position.

Given that, we want you to know that we respect your skills and your time. This code test isn’t crazy hard and it’s not designed to see whether you’re willing to sacrifice entire days of your life for a shot at the job.

It is designed to make sure that you can solve problems (even made-up ones!) and do so in a way that’s easy for other developers to follow.

With that in mind, we recommend you spend 2-4 hours on it. This isn’t a university assignment where you need to get 100%. This is a chance to show that your code isn’t going to make other people on the team cry.

You're unlikely to be able to demonstrate everything in this list in the time.  Please consider it a jumping off point to show what you you know.

- Composer
- PHPUnit (Unit and integration tests)
- PHPStan
- Docker
- Docker Compose
- Dependency Injection
- Strategy Pattern
- Sensible types
- Source control and code review
- Good separation/encapsulation
- Small accurate interfaces

To avoid confusion, this is a data modeling exercise, not something that need a UI or framework. Unit tests or something that you run from the command line are plenty and will give you more time to show us how you think about engineering rather than spending it on annoying wiring work!

If successful, you will progress to a 20-30 minute final interview after which we will not ask you to undertake any further unpaid assessment.

Third Coding Challenge
Please check the following link for the assignment - https://www.dropbox.com/s/dcrlgiul2dr26bm/architech-labs-code-test.pdf?dl=0

Good luck!


======

Acme Widget Co are the leading provider of made up widgets and they’ve contracted you to
create a proof of concept for their new sales system.

They sell three products –

| Product      | Code | Price  |
|--------------|------|--------|
| Red Widget   | R01  | $32.95 |
| Green Widget | G01  | $24.95 |
| Blue Widget  | B01  | $7.95  |

To incentivize customers to spend more, delivery costs are reduced based on the amount
spent. Orders under $50 cost $4.95. For orders under $90, delivery costs $2.95. Orders of
$90 or more have free delivery.

They are also experimenting with special offers. The initial offer will be “buy one red widget,
get the second half price”.

Your job is to implement the basket which needs to have the following interface –

• It is initialized with the product catalogue, delivery charge rules, and offers (the
format of how these are passed it up to you)
• It has an add method that takes the product code as a parameter.
• It has a total method that returns the total cost of the basket, taking into account
the delivery and offer rules.

Here are some example baskets and expected totals to help you check your
implementation.

---------------------------------------
| Products                   | Total  |
|----------------------------|--------|
| B01, G01                   | $37.85 |
| R01, R01                   | $54.37 |
| R01, G01                   | $60.85 |
| B01, B01, R01, R01, R01    | $98.27 |
---------------------------------------

What we expect to see –

• A solution written in easy to understand and update PHP
• A README file explaining how it works and any assumptions you’ve made
• Pushed to a public Github repo