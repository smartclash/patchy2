-- Don't use if you are using the installer

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isAccountType` int(1) NOT NULL DEFAULT '1',
  `uniqueSalt` varchar(512) NOT NULL,
  `otherUniqueSalt` varchar(512) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(384) NOT NULL,
  `token` varchar(384) NOT NULL,
  `tokenLogins` int(1) NOT NULL DEFAULT '0',
  `accountCreatedIP` varchar(15) NOT NULL,
  `signUpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usedPatches` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
