
CREATE TABLE IF NOT EXISTS `question` (
  `qid` varchar(7) NOT NULL,
  `question` text NOT NULL,
  `answer1` text NOT NULL,
  `answer2` text NOT NULL,
  `answer3` text NOT NULL,
  `answer4` text NOT NULL,
  `correct_answer` int(11) NOT NULL,
  `subtopicid` varchar(7) DEFAULT NULL,
  `correct_count` int(11) DEFAULT NULL,
  `use_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`qid`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `correct_answer`, `subtopicid`, `correct_count`, `use_count`) VALUES
('001', 'What car does Ken Block currently drive for his popular "Gymkhana" drifting video series?', 'Subaru STI', 'Ford Fiesta', 'BMW M3', 'Porsche 911', 2, 'DRI', 0, 0),
('002', 'Niki Lauda is a famous racer for what racing competition?', 'NASCAR', 'WRC', 'Formula 1', 'GT', 3, 'DRI', 0, 0),
('003', 'Which famous speedway was NASCAR driver Dale Earnhardt Sr. racing at when he died from an accident on the track?', 'Daytona International Speedway', 'Indianapolis Motor Speedway', 'Las Vegas Motor Speedway', 'Talladega Superspeedway', 1, 'DRI', 0, 0),
('004', '"Drift King" Keiichi Tsuchiya is famous for driving which car?', 'Nissan Skyline R34', 'Acura NSX Type R', 'Toyota Sprinter Trueno AE86', 'Toyota Supra Twin Turbo MKIV', 3, 'DRI', 0, 0),
('005', 'What course does Toyota own?', 'Suzuka Circuit', 'Fuji Speedway', 'Autopolis', 'Nakayama Circuit', 2, 'COU', 0, 0),
('006', 'What famous track features a 14 mile loop that is used by many manufacturers in testing their cars?', 'Mazda Raceway Laguna Seca', 'Nürburgring ', 'Circuit de Monaco', 'Daytona Motor Speedway', 2, 'COU', 0, 0),
('007', 'What famous Japanese car was never sold in the US domestic market?', 'Acura NSX', 'Toyota Altezza', 'Toyota 2000GT', 'Nissan Skyline GTR R34', 4, 'IMP', 0, 0),
('008', 'What is the only American-made car to win the 24 Hours of Le Mans race?', 'Ford GT40', 'Chevrolet Chevelle', 'Chevrolet Corvette ', 'Ford Boss 429 Mustang', 1, 'DOM', 0, 0),
('009', 'What car bears the name "Stingray"?', 'Chrysler Crossfire', 'Chevrolet Camaro', 'Pontiac Firebird', 'Chevrolet Corvette', 4, 'DOM', 0, 0),
('010', 'What was the first Japanese car produced in the United States?', '1982 Honda Accord', '1985 Toyota Camry', '1989 Mazda Miata', '1970 Datsun 240z', 1, 'IMP', 0, 0),
('011', 'How much horsepower did the first Porsche 911 make?', '45 HP', '90 HP', '130 HP', '180 HP', 3, 'IMP', 0, 0),
('012', 'What is Toyota''s first supercar?', 'Lexus LFA', 'Toyota Supra Twin Turbo', 'Toyota Sprinter Trueno AE86', 'Toyota 2000GT', 4, 'IMP', 0, 0),
('013', 'What was the first Ferrari that could drive faster than 198 MPH?', 'Ferrri F40', 'Ferrari Testarossa', 'Ferrari F430', 'Ferrari Enzo', 1, 'IMP', 0, 0),
('014', 'Which Japanese manufacturer sold the first car in the UK?', 'Mazda', 'Daihatsu', 'Toyota', 'Honda', 2, 'IMP', 0, 0),
('015', 'What does a tire aspect ratio mean?', 'The ratio of width of the tire to the sidewall.', 'The ratio of the durability of the tire to the cost.', 'The ratio of grip in the tires.', 'The ratio of how big the wheel for the tire needs to be compared to how wide.', 1, 'MOD', 0, 0),
('016', 'What octane gas is racing fuel consisted of?', '91 Octane', '100 Octane', '93 Octane', '125 Octane', 2, 'RAC', 0, 0),
('017', 'What are coilovers?', 'Adjustable shock absorber with springs', 'Road magnet sensors', 'Engine modification that adds horsepower', 'Induction coil in a car''s ignition system', 1, 'MOD', 0, 0),
('018', 'What is wheel offset?', 'The size difference between a replacement wheel and the original.', 'The distance between the drive and passenger side wheels.', 'The measured distance between the hub mounting surface and the center of the rim.', 'How large the diameter of the wheel is.', 3, 'MOD', 0, 0),
('019', 'What does HID stand for?', 'Hidden internal DVD', 'High Intensity Discharge', 'Highly Integrated Doorhandles ', 'Hydrogen Infused Diesel', 2, 'MOD', 0, 0),
('020', 'What is a redline?', 'The line at the end of a race track.', 'A penalty in racing competitions.', 'The highest an engine can rev.', 'The fastest a car can travel.', 3, 'RAC', 0, 0),
('021', 'What cars are usually used for drifting?', 'All Wheel Drive', 'Four Wheel Drive', 'Front Wheel Drive', 'Rear wheel Drive', 4, 'RAC', 0, 0),
('022', 'What manufacturer was the first to ffer full LED headlights?', 'Mercedes-Benz', 'BMW', 'Lexus', 'Audi', 3, 'IMP', 0, 0),
('023', 'What car bears the name "Godzilla"?', 'Nissan Fairlady Z', 'Toyota Supra', 'Nissan Skyline GTR', 'Acura Integra Type R', 3, 'IMP', 0, 0),
('024', 'What performance brand was discontinued in 2010?', 'Plymoth', 'Oldsmobile', 'Geo', 'Pontiac', 4, 'DOM', 0, 0),
('025', 'What car used to be a coupe but was resurrected in 2005 as a sedan?', 'Dodge Charger', 'Plymouth Belvedere', 'Chevrolet Cruze', 'Chevrolet Impala', 1, 'DOM', 0, 0),
('026', 'What is a turbocharger?', 'Belt driven forced-induction system', 'Air pressure forced-induction system', 'Variable valve timing mechanism', 'System that intakes colder air for increased engine power', 2, 'MOD', 0, 0),
('027', 'Where is Mazda Speedway Laguna Seca located?', 'Alabama', 'Indianapolis', 'Texas', 'California', 4, 'COU', 0, 0),
('028', 'What famous European race track is known for its many tight corners and height changes, as well a tunnel?', 'Circuit de Spa-Francorchamps', 'Autodromo Nazionale Monza', 'Nürburgring', 'Circuit de Monaco', 4, 'COU', 0, 0),
('029', 'What is autocrossing?', 'An off-road dirt course for racing', 'A race circuit set up for drifting', 'A small course set up with many turns to emphasize turning ability', 'A track set up on public streets', 3, 'RAC', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
