Dear Paul.

App is at http://timecard.test/

Employee login
 employee@timecard.com
 password

Boss login
 boss@timecard.com
 password

I made some assumptions / cuts to the scope of the project so I could get it done in the time I had available this week.

 - No correction for different time zones.

 - I've estimated the tax (at 15%) and national insurance (at 12%) deductions. I took a look at the tax tables but implementing all of that logic would have taken another week.

 - I've taken a simple approach to calculating overtime. Overtime = total time - contracted time. Contracted time is how many hours the employee is contracted to work.

 - Overtime rate is set per employee rather than calculated at 1.5x or 2x rules depending on when the overtime is worked.

 - Changes to an employee's rate or contracted hours affect the next week. They're not applied to the remaining days this week.

 - A single time period per working day. No allowance for split shifts, time off during the day or even recording breaks.

 - A time period can't span across two days. It can't handle signing in on one day and signing out on the next. If a user logs into the app today, hits the sign in button and stays logged in till tomorrow then hits the sign out button it's going to put tomorrow's sign out time into today's record. Validation would catch this but I've not built it yet.

 - I've allowed the employee to edit their recorded time in the current week. I first built it with just a sign in and sign out button like you'd get if this was connected to an access control system but your brief asked for employees to be able to enter their time so I added the ability to edit their time in case they forgot to sign in / out.

 - Editing time is only allowed during the current week. I've only done this via the UI but it would probably be added as a validation rule. 

 - If the edit your own timesheet facility stayed it would be smart to write an audit trail.

 - I've not included any employee CR D. Just (U)pdating an employee to get a feel for how the UI might look.

 - I've used Laravel's native user auth system + an admin auth middleware. I've not done stuff like preventing strangers registering other than remove the link.

 - I've not included any validation and error handling.

 - The UI is pretty simple. No ajax enhancements. The app could do with either pagination or incremental loading for the timesheet lists if they got long enough to feel slow or cumbersome.

 - The boss view of the employee list only includes total hours and total (gross) pay. The logic for adding tax, national insurance and net pay is pretty much the same as for these figures.

 - I only wrote a couple of unit tests to help me when I was working out the calculation logic. More tests required.

 - I've not done any databse optimization. I think the UUID field I've selected isn't the fastest one for sqlite. The UUID trait code supports other field types so this would be worth a more detailed look.

 - Hard coded the db config and copied .env to testing.env rather than setting up a propper testing environment.

 Best wishes

 Pete Bowen




